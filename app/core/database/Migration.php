<?php

namespace Database;

use App\Core\App;

class Migration
{
    protected $connection;

    public function __construct()
    {
        $this->connection = App::get('database');
    }
}