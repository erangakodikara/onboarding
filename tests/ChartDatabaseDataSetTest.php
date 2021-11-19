<?php

use onboard\dao\data\impl\ChartDatabaseDataSet;
require_once 'src/dao/data/impl/ChartDatabaseDataSet.php';

class ChartDatabaseDataSetTest extends \PHPUnit\Framework\TestCase
{

    public function testGetData()
    {
        $chartDataObj = new ChartDatabaseDataSet();
        $chartData = $chartDataObj->getData();
        $this->assertSame(9,count($chartData));
    }
}