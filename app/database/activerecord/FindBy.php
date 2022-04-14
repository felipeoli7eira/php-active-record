<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecord;
use app\database\interfaces\ActiveRecordExecute;
use Throwable;

class FindBy implements ActiveRecordExecute
{
    private string $whereColumn;
    private $whereVal;
    private string $columnsToReturn;

    /**
     * Coluna e valor para utilização na cláusula WHERE
     * @param mixed $column coluna do WHERE
     * @param mixed $value valor do WHERE
     * @return never
    */
    public function __construct(string $column, $value, string $columnsToReturn = '*')
    {
        $this->whereColumn = $column;
        $this->whereVal = $value;
        $this->columnsToReturn = $columnsToReturn;
    }

    public function execute(ActiveRecord $context)
    {
        try
        {
            $sql = $this->mountSQLStatement($context);

            $connection = Connection::connect();

            $findBy = $connection->prepare($sql);

            $findBy->execute([$this->whereColumn => $this->whereVal]);

            return $findBy->fetch();
        }
        catch (Throwable $th)
        {
            return $th->getMessage();
        }
    }

    /**
     * Monta e retorna uma Query de FindBy
    */
    private function mountSQLStatement(ActiveRecord $context): string
    {
        return "SELECT {$this->columnsToReturn} FROM {$context->getTableName()} WHERE {$this->whereColumn} = :{$this->whereColumn}";
    }
}
