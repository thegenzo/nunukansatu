<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('title', 200);
            $table->string('subtitle', 500)->nullable();
            $table->text('message')->nullable();
            $table->string('reference_number', 150)->nullable();
            $table->date('published_on')->nullable();
            $table->boolean('is_active')->default(false)->index();
            $table->boolean('show_qr')->default(true);
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->string('pdf_disk')->default('local');
            $table->string('pdf_path')->nullable();
            $table->string('pdf_file_name')->nullable();
            $table->text('pdf_url')->nullable();
            $table->timestamps();
        });

        // Preserve the announcement already displayed on the home page.
        DB::table('announcements')->insert([
            'public_id' => '9e4a8d36-d411-4a69-a422-4c1be8b6f126',
            'title' => 'HASIL TIGA BESAR SELEKSI TERBUKA',
            'subtitle' => 'PENGISIAN JABATAN PIMPINAN TINGGI PRATAMA SEKRETARIS DAERAH KABUPATEN NUNUKAN TAHUN 2026',
            'reference_number' => 'B/16/PANSEL2026-1.800.1.2.6',
            'published_on' => '2026-10-28',
            'is_active' => true,
            'show_qr' => false,
            'pdf_disk' => 'public',
            'pdf_url' => 'https://assets.qloudkita.id/'.rawurlencode('Pengumuman Pansel 16-2026 Hasil 3 Besar Selter Sekda Kab Nunukan 2026_.pdf'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
