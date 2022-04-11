<?php

namespace app\database\interfaces;

interface ActiveRecordExecute
{
    public function execute(ActiveRecord $object);
}
