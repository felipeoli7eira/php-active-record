<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use Throwable;
use app\database\interfaces\ActiveRecordExecute;

class Insert implements ActiveRecordExecute
{
    /**
     * @param \app\database\interfaces\ActiveRecord $context o $this do model
     * @return bool|array true caso o insert tenha sido feito ou um array com as informações da exceção
    */
    public function execute(\app\database\interfaces\ActiveRecord $context)
    {
        try
        {
            $insertStrQuery = $this->mountInsertStrQuery($context);

            $conn = Connection::connect();
            $prepare = $conn->prepare($insertStrQuery);

            return !!$prepare->execute($context->getAttributes());
        }
        catch (Throwable $th)
        {
            return ['result' => false, 'exception' => $th->getMessage()];
        }
    }

    private function mountInsertStrQuery(\app\database\interfaces\ActiveRecord $context): string
    {
        $strInsert = "INSERT INTO {$context->getTableName()} (";
        $strInsert .= implode( ', ', array_keys($context->getAttributes()) ) . ') VALUES (:';
        $strInsert .= implode( ', :', array_keys($context->getAttributes()) ) . ');';

        return $strInsert;
    }
}
