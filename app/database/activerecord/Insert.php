<?php

namespace app\database\activerecord;

use app\database\interfaces\ActiveRecordExecute;

class Insert implements ActiveRecordExecute
{
    public function execute(\app\database\interfaces\ActiveRecord $context)
    {
        return $context->getAttributes();
    }
}
