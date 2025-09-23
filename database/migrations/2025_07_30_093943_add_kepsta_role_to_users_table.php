<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifikasi kolom enum untuk menambahkan 'kepsta'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'editor', 'kepsta') NOT NULL DEFAULT 'editor'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Modifikasi kolom enum untuk menghapus 'kepsta'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'editor') NOT NULL DEFAULT 'editor'");
    }
};
