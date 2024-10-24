<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama kandidat gabungan (opsional)
            $table->foreignId('ketua_id')->constrained('users')->onDelete('cascade'); // Ketua dari tabel users
            $table->foreignId('wakil_id')->nullable()->constrained('users')->onDelete('cascade'); // Wakil dari tabel users
            $table->text('visi');
            $table->text('misi');
            $table->string('ketua_image')->nullable(); // Gambar ketua
            $table->string('wakil_image')->nullable(); // Gambar wakil
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade'); // Asosiasi kandidat dengan sekolah
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
}
