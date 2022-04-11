<?php

namespace app\database\activerecord;

use app\database\interfaces\ActiveRecord;
use app\database\interfaces\ActiveRecordExecute;

class Find implements ActiveRecordExecute
{
    public function execute(ActiveRecord $context)
    {
        return 'find';
    }
}
