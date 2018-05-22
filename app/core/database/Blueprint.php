<?php
/**
 * User: adrian
 * Date: 5/21/18
 * Time: 7:53 AM
 */

namespace App\Core\Database;


class Blueprint
{
    /** @var string[] $fields */
    public $fields;

    public function increments($column, $size = 10): void
    {
        $this->fields[$column] = "$column INT($size) UNSIGNED PRIMARY KEY AUTO_INCREMENT";
    }

    public function string($column, $size = 255): void
    {
        $this->fields[$column] = "$column VARCHAR($size)";
    }
}