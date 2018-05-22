<?php
namespace Tests\Unit;

use App\Core\Database\Blueprint;
use Tests\TestCase;

class BlueprintTest extends TestCase
{
    protected $blueprint;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->blueprint = new Blueprint();
    }

    /** @test */
    public function it_should_create_a_sql_string_for_an_auto_incrementing_id(): void
    {
        $column = 'id';

        $this->blueprint->increments($column);

        $this->assertEquals("$column INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT", $this->blueprint->fields[$column]);
    }

    /** @test */
    public function it_should_create_a_string_field(): void
    {
        $column = 'name';

        $this->blueprint->string($column);

        $this->assertEquals("$column VARCHAR(255)", $this->blueprint->fields[$column]);
    }
}