<?php

namespace onboard\core;

use Exception;
use PDO;
use PDOException;

/**
 * Class conectar
 * @package onboard\core
 */
class conectar
{
    private $driver;
    private $host, $user, $pass, $database, $charset;
    private $dataFile;

    /**
     * conectar constructor.
     */
    public function __construct()
    {
        require_once 'config/database.php';

        $this->dataFile = DATA_FILE;
        $this->driver = DB_DRIVER;
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->database = DB_DATABASE;
        $this->charset = DB_CHARSET;
    }

    /**
     * @return array
     */
    public function csvFileConector()
    {
        $dataArray = [];
        if (($open = fopen("db/export.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
                $dataArray[] = $data;
            }

            fclose($open);
        }
        return $dataArray;
    }

    /**
     * Db Conector
     */
    public function dbConector()
    {
        $dbdata = $this->driver . ':host=' . $this->host . ';dbname=' . $this->database . ';charset=' . $this->charset;

        try {
            $connection = new PDO($dbdata, $this->user, $this->pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            //We throw the exception
            throw new Exception('Problem establishing the connection.');
        }
    }

}

