<?php
namespace onboard\dao\data\impl;

use onboard\dao\data\DataSetI;
use onboard\dao\db\impl\CSVConnector;
use onboard\src\dto\InterviewDTO;
use onboard\src\util\ReadCSV;

require_once 'src/dao/data/DataSetI.php';
require_once 'src/dao/db/impl/CSVConnector.php';
require_once 'src/dto/InterviewDTO.php';
require_once 'src/util/ReadCSV.php';

class ChartCSVDataSet implements DataSetI
{
    private $dataset;

    public function __construct()
    {
        $csvData = new CSVConnector();
        try {
            $this->dataset = new ReadCSV($csvData->dataConnector());
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function getData()
    {
        $dataArray = [];
        for ($i = 1; $i < $this->dataset->getRowCount(); ++$i) {
            $interview = new InterviewDTO();
            $interview->setUserId($this->dataset->getValueAt($i, 0));
            $interview->setCreatedAt($this->dataset->getValueAt($i, 1));
            $interview->setOnboardPercentage($this->dataset->getValueAt($i, 2));
            $interview->setCountApplications($this->dataset->getValueAt($i, 3));
            $interview->setCountAcceptedApplications($this->dataset->getValueAt($i, 4));

            $dataArray[] = $interview;
        }

        return $dataArray;
    }
}