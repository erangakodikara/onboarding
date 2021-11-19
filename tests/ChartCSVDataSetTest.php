<?php


use onboard\dao\data\impl\ChartCSVDataSet;
require_once 'src/dao/data/impl/ChartCSVDataSet.php';

class ChartCSVDataSetTest extends \PHPUnit\Framework\TestCase
{

    public function testGetData()
    {
        $chartDataObj = new ChartCSVDataSet();
        $chartData = $chartDataObj->getData();
        $this->assertSame(9,count($chartData));
    }
}