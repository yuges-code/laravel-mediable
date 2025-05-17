<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Config\Config;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getMediaClass(Media::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getMediaKeyType(KeyType::BigInteger));

            $table->keyMorphs(
                Config::getMediableKeyType(KeyType::BigInteger),
                Config::getMediableRelationName()
            );

            $table->string('collection')->index();
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
            $table->json('placeholders')->nullable();

            $table->order();

            $table->unique(['disk', 'directory', 'filename', 'extension']);

            $table->timestamps();
        });
    }
};
