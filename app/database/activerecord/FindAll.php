<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecord;
use app\database\interfaces\ActiveRecordExecute;
use Exception;
use Throwable;

class FindAll implements ActiveRecordExecute
{
    private string $where;
    private string $fields;
    private string $limit;
    private string $offset;

    /**
     * Parametros para montar a query de FindAll
     * @param string $where
     * @param string $fields
     * @param string $limit
     * @param string $offset
     * @return never
    */
    public function __construct(string $where = '1 = 1', string $fields = '*', string $limit = '', string $offset = '')
    {
        $this->where = $where;
        $this->fields = $fields;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function execute(ActiveRecord $context)
    {
        try
        {
            $sql = $this->mountSQLStatement($context);

            $connection = Connection::connect();

            $findBy = $connection->prepare($sql);

            $findBy->execute();

            return $findBy->fetchAll();
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
        $strQuery = "SELECT {$this->fields} FROM {$context->getTableName()} WHERE {$this->where}";
        $strQuery .= empty($this->limit) ? '' : " LIMIT {$this->limit}";
        $strQuery .= $this->offset != '' ? " OFFSET {$this->offset}" : '';

        return $strQuery;
    }
}
