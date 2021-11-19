<?php


use onboard\src\service\impl\ChartService;
require_once 'src/service/impl/ChartService.php';

class ChartServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testGetChartData() {
        $chartService = new ChartService();
        $chartData = $chartService->getChartData();
        $this->assertSame(7,count($chartData));
    }
}