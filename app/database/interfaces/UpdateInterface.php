<?php

namespace app\database\interfaces;

interface UpdateInterface
{
    public function update(\app\database\interfaces\ActiveRecord $activeRecord);
}
