<?php

namespace app\database\interfaces;

interface InsertInterface
{
    public function insert(\app\database\interfaces\ActiveRecord $activeRecord);
}
