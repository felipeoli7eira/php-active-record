<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecord;
use app\database\interfaces\ActiveRecordExecute;
use Throwable;

class Update implements ActiveRecordExecute
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
            $sqlUpdate = $this->mountUpdateSQLStatement($context);

            $connection = Connection::connect();

            $update = $connection->prepare($sqlUpdate);

            $execParams = array_merge($context->getAttributes(), [$this->whereColumn => $this->whereVal]);

            $update->execute($execParams);

            return $update->rowCount();
        }
        catch (Throwable $th)
        {
            var_dump($th->getMessage());
        }
    }

    /**
     * Monta e retorna uma Query de Update
    */
    private function mountUpdateSQLStatement(ActiveRecord $context): string
    {
        $updateStmt = "UPDATE {$context->getTableName()} SET ";

        foreach ($context->getAttributes() as $column => $value) {

            if ($column === 'id') continue; // pula para a próxima chave caso a atual se chame "id"

            $updateStmt .= "{$column} = :{$column}, ";
        }

        $updateStmt = rtrim($updateStmt, ', ');

        $updateStmt .= " WHERE {$this->whereColumn} = :{$this->whereColumn}";

        return $updateStmt;
    }
}
