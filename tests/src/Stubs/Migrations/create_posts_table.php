<?php

use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(
        protected ?string $table = 'posts'
    ) {
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key();

            $table->string('title');

            $table->timestamps();
            $table->softDeletes();
        });
    }
};
