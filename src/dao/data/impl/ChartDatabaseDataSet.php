<?php


namespace onboard\dao\data\impl;
use onboard\dao\data\DataSetI;

require_once 'src/dao/db/impl/DBConnector.php';
require_once 'src/dao/data/DataSetI.php';

use onboard\dao\db\impl\DBConnector;
use PDO;

class ChartDatabaseDataSet implements DataSetI
{
    private $db;
    private $tableName = CHART_DATA_TABLE;

    public function __construct()
    {
        $connector = new DBConnector();
        try {
            $this->db = $connector->dataConnector();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function getData()
    {
        $consultation = $this->db->prepare("SELECT * FROM " . $this->tableName);
        $consultation->execute([]);

        /* Fetch all of the remaining rows in the result set */
        return $consultation->fetchAll(PDO::FETCH_OBJ);
    }
}