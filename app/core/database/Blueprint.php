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
    protected $currentField;

    /**
     * Field modifier method
     *
     * @return $this
     */
    public function auto_increment(): self
    {
        $this->fields[$this->currentField] .= ' AUTO_INCREMENT';

        return $this;
    }

    private function default($default)
    {
        $this->fields[$this->currentField] .= " DEFAULT {$default}";

        return $this;
    }

    /**
     * Field modifier method
     *
     * @param string $column
     * @param int    $size
     * @return $this
     */
    public function increments(string $column, int $size = 10): self
    {
        $this->setField($column, 'INT', $size)
             ->unsigned()
            ->primary()
            ->auto_increment();

        return $this;
    }

    public function integer(string $column, int $size = 10): self
    {
        $this->setField($column, 'INT', $size);

        return $this;
    }

    /**
     * Field modifier method
     *
     * @return $this
     */
    public function primary(): self
    {
        $this->fields[$this->currentField] .= ' PRIMARY KEY';

        return $this;
    }

    private function setField(string $column, string $sqlOption, string $size): self
    {
        $this->currentField = $column;
        $this->fields[$column] = "{$column} {$sqlOption}({$size})";

        return $this;
    }

    public function string(string $column, int $size = 255): self
    {
        $this->setField($column, 'VARCHAR', $size);

        return $this;
    }

    public function timestamps()
    {
        $this->currentField = $column = 'created_at';
        $this->fields[$this->currentField] = "{$column} TIMESTAMP";
        $this->default('CURRENT_TIMESTAMP');
        $this->currentField = $column = 'updated_at';
        $this->fields[$this->currentField] = "{$column} TIMESTAMP";
        $this->default('CURRENT_TIMESTAMP');

        return $this;
    }

    /**
     * Field modifier method
     *
     * @return $this
     */
    public function unsigned(): self
    {
        $field = $this->currentField;
        $this->fields[$field] .= ' UNSIGNED';

        return $this;
    }
}