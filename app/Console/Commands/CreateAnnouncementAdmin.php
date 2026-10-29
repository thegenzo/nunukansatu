<?php

namespace App\Console\Commands;

use App\Models\AnnouncementAdmin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateAnnouncementAdmin extends Command
{
    protected $signature = 'announcements:admin {--email=} {--name=}';

    protected $description = 'Buat akun admin pengumuman atau ganti kata sandi akun yang sudah ada';

    public function handle(): int
    {
        $email = Str::lower(trim($this->option('email') ?: $this->ask('Email admin')));
        $name = $this->option('name') ?: $this->ask('Nama admin');
        $password = $this->secret('Kata sandi baru (minimal 12 karakter)');
        $confirmation = $this->secret('Ulangi kata sandi baru');
        $validator = Validator::make([
            'email' => $email, 'name' => $name, 'password' => $password, 'password_confirmation' => $confirmation,
        ], [
            'email' => 'required|email|max:255', 'name' => 'required|string|max:255',
            'password' => 'required|string|min:12|max:1024|confirmed',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $admin = AnnouncementAdmin::firstOrNew(['email' => $email]);
        $admin->fill(['name' => $name, 'password' => $password]);
        $admin->remember_token = Str::random(60);
        $admin->save();
        $this->info('Akun admin tersimpan. Masuk melalui '.url('/admin/login'));

        return self::SUCCESS;
    }
}
