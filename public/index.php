<?php

ini_set('display_errors', true);

require __DIR__ . '/../vendor/autoload.php';

use app\database\activerecord\Update;
use app\database\models\User;

$user = new User();
$user->full_name = 'Felipe';
$user->email = 'felipe@dev.com.br';

var_dump ($user->execute(new update('id', 1)));