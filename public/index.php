<?php

ini_set('display_errors', true);

require __DIR__ . '/../vendor/autoload.php';

use app\database\activerecord\Delete;
use app\database\activerecord\FindAll;
use app\database\activerecord\FindBy;
use app\database\activerecord\Insert;
use app\database\activerecord\Update;
use app\database\models\User;

$user = new User();
$user->full_name = 'Pedro';
$user->email = 'pedro@dev.com.br';

// var_dump( $user->execute(new Insert()) );
// var_dump( $user->execute(new Delete('id', 1)) );
var_dump( $user->execute(new FindAll()));