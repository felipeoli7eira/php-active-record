<?php

namespace app\database\activerecord;

use app\database\interfaces\ActiveRecord as InterfaceActiveRecord;
use ReflectionClass;

abstract class ActiveRecord implements InterfaceActiveRecord
{
    /** @var string $table Nome da tabela do Model */
    protected ?string $table = null;

    /** @var array $attributes Armazena todos os dados do model */
    protected array $attributes = [];

    public function __construct()
    {
        if (is_null($this->table)) {
            $this->table =strtolower(
                (new ReflectionClass($this))->getShortName()
            );
        }
    }

    /**
     * @param mixed $value
    */
    public function __set(string $prop, $value)
    {
        $this->attributes[ $prop ] = $value;
    }

    /**
     * @return mixed
    */
    public function __get(string $prop)
    {
        return $this->attributes[ $prop ];
    }

    /**
     * Recupera o nome da tabela associada ao model
     * @return string
    */
    public function getTableName()
    {
        return $this->table;
    }

    /**
     * Retorna todos os atributos de um Model
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    // interface method
    public function execute(\app\database\interfaces\ActiveRecordExecute $dbOperationObject)
    {
        return $dbOperationObject->execute($this);
    }
}
