<?php

namespace app\database\connection;

use PDO;
use PDOException;

class Connection
{
    /** @property UNDEFINED|NULL|PDO $pdo Instância de PDO */
    private static $pdo;

    /**
     * Retorna uma Instância de PDO ou uma string de PDOException
     * @return PDO|string
    */
    public static function connect()
    {
        try
        {
            if (is_null(static::$pdo)) {
                static::$pdo = new PDO(
                    'mysql:host=localhost;dbname=active_record;charset=UTF8',
                    'root',
                    'root',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]
                );
            }

            return static::$pdo;
        }
        catch (PDOException $e)
        {
            return $e->getMessage();
        }
    }
}
