<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    protected string $table = 'media';

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('disk', 32);
            $table->string('directory');
            $table->string('filename');
            $table->string('extension', 32);
            $table->string('mime', 128);
            $table->unsignedBigInteger('size');
            $table->boolean('temporary')->index();
            $table->json('manipulations')->nullable();
            $table->json('conversions')->nullable();
            $table->json('responsive')->nullable();
            $table->json('properties')->nullable();
            $table->text('placeholder')->nullable();

            $table->unique(['disk', 'directory', 'filename', 'extension']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
