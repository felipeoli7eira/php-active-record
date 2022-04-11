<?php

namespace app\database\models;

use app\database\activerecord\ActiveRecord;

class User extends ActiveRecord
{
    /** @var string $table Nome da tabela do Model */
    protected ?string $table = 'users';
}
