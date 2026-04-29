<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('konten_sosmed', function (Blueprint $table) {
            $table->id();
            $table->string('platform', 50);
            $table->string('judul');
            $table->date('tanggal_upload');
            $table->string('screenshot')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konten_sosmed');
    }
};
