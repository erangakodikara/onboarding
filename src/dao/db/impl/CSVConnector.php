<?php


namespace onboard\dao\db\impl;


use Exception;
use onboard\src\dao\db\ConnectorI;
require_once 'src/dao/db/ConnectorI.php';
require_once 'config/database.php';

class CSVConnector implements ConnectorI
{
    private $dataFile;

    public function __construct()
    {

        $this->dataFile = DATA_FILE;

    }

    public function dataConnector()
    {
        if (!file_exists($this->dataFile)) {
            throw new Exception('File not found.');
        }

        $fp = fopen($this->dataFile, "r");
        if (!$fp) {
            throw new Exception('File open failed.');
        }

        $dataArray = [];
        if (($open = fopen($this->dataFile, "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ";")) !== false) {
                $dataArray[] = $data;
            }

            fclose($open);
        } else {
            throw new Exception('Problem in reading  CSV');
        }

        if (empty($dataArray)) {
            throw new Exception('No data in the CSV');
        }
        return $dataArray;


    }
}