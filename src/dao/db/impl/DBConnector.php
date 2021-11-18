<?php


namespace onboard\dao\db\impl;

require_once 'src/dao/db/ConnectorI.php';

use Exception;
use onboard\src\dao\db\ConnectorI;
use PDO;
use PDOException;

require_once 'config/database.php';

class DBConnector implements ConnectorI
{
    private $driver;
    private $host, $user, $pass, $database, $charset;

    public function __construct()
    {
        $this->driver = DB_DRIVER;
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->database = DB_DATABASE;
        $this->charset = DB_CHARSET;
    }

    public function dataConnector()
    {
        $dbdata = $this->driver . ':host=' . $this->host . ';dbname=' . $this->database . ';charset=' . $this->charset;

        try {
            $connection = new PDO($dbdata, $this->user, $this->pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            //throw the exception
            throw new Exception('Problem establishing the connection.');
        }
    }
}