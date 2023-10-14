<?php

// Namespace desta classe.

namespace App\DAO;

// Namespaces utilizados nesta classe.

use \PDO;

use Exception;
use PDOException;

abstract class DAO extends PDO
{

    protected $conexao;

    protected function __construct()
    {

        try
        {

            $dsn = "mysql:host=" . $_ENV["database"]["host"] . ";dbname=" . $_ENV["database"]["db_name"];

            $user = $_ENV["database"]["user"];
    
            $password = $_ENV["database"]["password"];
    
            $options = [
    
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    
            ];
    
            $this->conexao = new PDO($dsn, $user, $password, $options);

        }

        catch(PDOException $ex)
        {

            throw new Exception("Ocorreu um erro ao tentar uma conexão com o MySQL!", 0, $ex);

        }
        
    }

}

?>