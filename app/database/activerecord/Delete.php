<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecord;
use app\database\interfaces\ActiveRecordExecute;
use Throwable;

class Delete implements ActiveRecordExecute
{
    private string $whereColumn;
    private $whereVal;

    /**
     * Coluna e valor para utilização na cláusula WHERE
     * @param mixed $column coluna do WHERE
     * @param mixed $value valor do WHERE
     * @return never
    */
    public function __construct(string $column, $value)
    {
        $this->whereColumn = $column;
        $this->whereVal = $value;
    }

    public function execute(ActiveRecord $context)
    {
        try
        {
            $sqlDelete = $this->mountDeleteSQLStatement($context);

            $connection = Connection::connect();

            $update = $connection->prepare($sqlDelete);

            $update->execute([$this->whereColumn => $this->whereVal]);

            return $update->rowCount();
        }
        catch (Throwable $th)
        {
            return $th->getMessage();
        }
    }

    /**
     * Monta e retorna uma Query de Delete
    */
    private function mountDeleteSQLStatement(ActiveRecord $context): string
    {
        return "DELETE FROM {$context->getTableName()} WHERE {$this->whereColumn} = :{$this->whereColumn}";
    }
}
