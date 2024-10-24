<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nisn')->unique()->nullable(); // Optional for 'siswa'
            $table->string('nis')->unique()->nullable();  // Optional for 'siswa'
            $table->string('nip')->unique()->nullable();  // Optional for 'guru' or 'pegawai'
            $table->timestamps();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null'); // Relasi ke tabel kelas
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Relasi ke tabel roles
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade'); // Asosiasi kandidat dengan sekolah
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
