<?php

namespace app\database\interfaces;

interface ActiveRecord
{
    public function execute(ActiveRecordExecute $operation);
    public function getTableName();
    public function getAttributes();
}
