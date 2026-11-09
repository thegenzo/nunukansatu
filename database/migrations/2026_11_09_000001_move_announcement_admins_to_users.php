<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // SQLite must disable foreign-key checks before the table-rebuild transaction.
    public $withinTransaction = false;

    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            throw new RuntimeException('Tabel users harus tersedia sebelum migrasi akun admin dijalankan.');
        }

        $admins = Schema::hasTable('announcement_admins')
            ? DB::table('announcement_admins')->orderBy('id')->get()
            : collect();

        // Do not silently merge different accounts that happen to share an email.
        $emails = [];
        foreach ($admins as $admin) {
            $email = strtolower(trim($admin->email));
            if (! filter_var($email, FILTER_VALIDATE_EMAIL) || isset($emails[$email])) {
                throw new RuntimeException('Email akun admin lama tidak valid atau duplikat. Perbaiki data sebelum migrasi.');
            }
            $emails[$email] = true;
            if (Schema::hasColumn('users', 'email')) {
                $matches = DB::table('users')->whereRaw('LOWER(TRIM(email)) = ?', [$email])->get();
                if ($matches->count() > 1 || ($matches->count() === 1 && $matches->first()->password !== $admin->password)) {
                    throw new RuntimeException('Email admin sudah digunakan akun users dengan kredensial berbeda. Selesaikan konflik akun sebelum migrasi.');
                }
            }
        }

        if (! Schema::hasColumn('users', 'email')) {
            Schema::table('users', fn (Blueprint $table) => $table->string('email')->nullable()->unique());
        }
        if (! Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', fn (Blueprint $table) => $table->boolean('is_admin')->default(false));
        }

        // Admins created using email do not necessarily have a public NIK/phone.
        if (DB::getDriverName() === 'sqlite') {
            $this->makeSqliteIdentityNullable();
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->string('nik')->nullable()->change();
                $table->string('phone')->nullable()->change();
            });
        }

        DB::transaction(function () use ($admins) {
            foreach ($admins as $admin) {
                $email = strtolower(trim($admin->email));
                $existing = DB::table('users')->whereRaw('LOWER(TRIM(email)) = ?', [$email])->first();
                if ($existing) {
                    DB::table('users')->where('id', $existing->id)->update(['email' => $email, 'is_admin' => true]);
                } else {
                    // Query builder preserves the existing password hash exactly.
                    DB::table('users')->insert([
                        'name' => $admin->name,
                        'email' => $email,
                        'nik' => null,
                        'phone' => null,
                        'password' => $admin->password,
                        'verified' => true,
                        'is_admin' => true,
                        'remember_token' => null,
                        'created_at' => $admin->created_at ?? now(),
                        'updated_at' => $admin->updated_at ?? now(),
                    ]);
                }
                $migrated = DB::table('users')->whereRaw('LOWER(TRIM(email)) = ?', [$email])->first();
                if (! $migrated || ! $migrated->is_admin || $migrated->password !== $admin->password) {
                    throw new RuntimeException('Verifikasi pemindahan akun admin gagal; tabel lama dipertahankan.');
                }
            }
        });

        // The legacy authentication table is removed only after all hashes match.
        Schema::dropIfExists('announcement_admins');
    }

    private function makeSqliteIdentityNullable(): void
    {
        $columns = DB::select('PRAGMA table_info("users")');
        $required = array_filter($columns, fn ($column) => in_array($column->name, ['nik', 'phone'], true) && $column->notnull);
        if (! $required) {
            return;
        }

        // Laravel 10 needs DBAL for SQLite change(). Preserve the table's full
        // definition, indexes, triggers and rows without adding a dependency.
        $schema = DB::selectOne("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = 'users'")->sql;
        foreach ($required as $column) {
            $name = preg_quote($column->name, '/');
            $schema = preg_replace('/((?:"'.$name.'"|`'.$name.'`|\['.$name.'\]|\b'.$name.'\b)\s+[^,]+?)\s+not\s+null/i', '$1', $schema);
        }
        $schema = preg_replace('/^(CREATE\s+TABLE\s+)(?:"users"|`users`|\[users\]|users)(?=\s*\()/i', '${1}"users_admin_migration"', $schema, 1);
        $objects = DB::select("SELECT sql FROM sqlite_master WHERE tbl_name = 'users' AND type IN ('index', 'trigger') AND sql IS NOT NULL");
        $sequence = DB::selectOne("SELECT seq FROM sqlite_sequence WHERE name = 'users'");
        $foreignKeys = (bool) DB::selectOne('PRAGMA foreign_keys')->foreign_keys;
        DB::statement('PRAGMA foreign_keys = OFF');
        try {
            DB::transaction(function () use ($schema, $objects, $sequence) {
                DB::statement($schema);
                DB::statement('INSERT INTO "users_admin_migration" SELECT * FROM "users"');
                DB::statement('DROP TABLE "users"');
                DB::statement('ALTER TABLE "users_admin_migration" RENAME TO "users"');
                foreach ($objects as $object) {
                    DB::statement($object->sql);
                }
                if ($sequence) {
                    DB::table('sqlite_sequence')->where('name', 'users')->update(['seq' => $sequence->seq]);
                }
                if (DB::select('PRAGMA foreign_key_check')) {
                    throw new RuntimeException('Relasi users gagal diverifikasi setelah migrasi.');
                }
            });
        } finally {
            DB::statement('PRAGMA foreign_keys = '.($foreignKeys ? 'ON' : 'OFF'));
        }
    }

    public function down(): void
    {
        // Restore compatibility with the previous release without deleting users.
        if (! Schema::hasTable('announcement_admins')) {
            Schema::create('announcement_admins', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
        foreach (DB::table('users')->where('is_admin', true)->whereNotNull('email')->orderBy('id')->get() as $user) {
            DB::table('announcement_admins')->updateOrInsert(['email' => $user->email], [
                'name' => $user->name,
                'password' => $user->password,
                'remember_token' => null,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }
    }
};
