<?php

namespace Tests\Unit\Core;

use App\Core\Database\Blueprint;
use App\Core\Database\Schema;
use Tests\TestCase;

class SchemaTest extends TestCase
{
    /** @test */
    public function it_should_create_a_full_sql_schema_string_with_id_and_state_fields(): void
    {
        Schema::create('states', function(Blueprint $table) {
            $table->increments('id');
            $table->string('state', 2);
        });

        $schemaSql = Schema::toSql();

        $sql = 'CREATE TABLE `states` (id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT, state VARCHAR(2));';
        $this->assertEquals($sql, $schemaSql);
    }

    /** @test */
    public function it_should_create_a_table_schema_for_addresses(): void
    {
        Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('street', 100);
            $table->string('city', 100);
            $table->integer('state_id')->unsigned();
            $table->integer('zip_code', 9);
            $table->timestamps();
        });

        $schemaSql = Schema::toSql();

        Schema::run($schemaSql);

        // $sql = 'CREATE TABLE `addresses` (id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT, street VARCHAR(100), city VARCHAR(100), stateId INT(10) UNSIGNED, zipCode INT(9), CONSTRAINT fkAddressToState FOREIGN KEY (stateId) REFERENCES `states` (`id`), createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, modifiedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP);';
        $sql = 'CREATE TABLE `addresses` (id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT, street VARCHAR(100), city VARCHAR(100), state_id INT(10) UNSIGNED, zip_code INT(9), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);';

        $this->assertEquals($sql, $schemaSql);
    }
}