<?php

use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table', function (Blueprint $table) {
            $table->key();

            # fields...

            $table->timestamps();
        });
    }
};
