<?php

namespace Database\Migrations;

use App\Core\Database\Blueprint;
use App\Core\Database\Schema;

class CreateAddressesTable
{
    public function up(): void
    {
        Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('street', 100);
            $table->string('city', 100);
            $table->integer('state_id')->unsigned();
            $table->integer('zip_code', 9)->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
}