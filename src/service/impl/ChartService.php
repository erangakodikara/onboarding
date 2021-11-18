<?php


namespace onboard\src\service\impl;


use onboard\dao\data\impl\ChartCSVDataSet;
use onboard\src\service\ChartServiceI;
require_once 'src/service/ChartServiceI.php';
require_once 'src/dao/data/impl/ChartCSVDataSet.php';

class ChartService implements ChartServiceI
{

    private $fortyCount = 0;
    private $fiftyCount = 0;
    private $seventyCount = 0;
    private $ninetyCount = 0;
    private $ninetyNineCount = 0;
    private $hundredCount = 0;
    private $weekcohortCount = 0;


    /**
     * @return int
     */
    public function getFortyCount()
    {
        return $this->fortyCount;
    }

    /**
     * @param int $fortyCount
     */
    public function setFortyCount($fortyCount)
    {
        $this->fortyCount = $fortyCount;
    }

    /**
     * @return int
     */
    public function getFiftyCount()
    {
        return $this->fiftyCount;
    }

    /**
     * @param int $fiftyCount
     */
    public function setFiftyCount($fiftyCount)
    {
        $this->fiftyCount = $fiftyCount;
    }

    /**
     * @return int
     */
    public function getSeventyCount()
    {
        return $this->seventyCount;
    }

    /**
     * @param int $seventyCount
     */
    public function setSeventyCount($seventyCount)
    {
        $this->seventyCount = $seventyCount;
    }

    /**
     * @return int
     */
    public function getNinetyCount()
    {
        return $this->ninetyCount;
    }

    /**
     * @param int $ninetyCount
     */
    public function setNinetyCount($ninetyCount)
    {
        $this->ninetyCount = $ninetyCount;
    }

    /**
     * @return int
     */
    public function getNinetynineCount()
    {
        return $this->ninetyNineCount;
    }

    /**
     * @param int $ninetyNineCount
     */
    public function setNinetynineCount($ninetyNineCount)
    {
        $this->ninetyNineCount = $ninetyNineCount;
    }

    /**
     * @return int
     */
    public function getHundredCount()
    {
        return $this->hundredCount;
    }

    /**
     * @param int $hundredCount
     */
    public function setHundredCount($hundredCount)
    {
        $this->hundredCount = $hundredCount;
    }

    /**
     * @return int
     */
    public function getWeekcohortCount()
    {
        return $this->weekcohortCount;
    }

    /**
     * @param int $weekcohortCount
     */
    public function setWeekcohortCount($weekcohortCount)
    {
        $this->weekcohortCount = $weekcohortCount;
    }


    public function getChartData()
    {
        $chartDataObj = new ChartCSVDataSet();
        $chartData = $chartDataObj->getData();
        return $this->createChartData($chartData);
    }

    private function createChartData($data)
    {
        $weekNo = 0;
        $start = 0;
        $chartData = $this->initialChartData();
        $endDate = '';
        foreach ($data as $value) {
            if ($start == 0) {
                $startDate = $value->getCreatedAt();
                $endDate = date('Y-m-d', strtotime('+1 week', strtotime($startDate)));
                $start++;
            }

            $this->checkOnboardPercentage($value->getOnboardPercentage());
            $this->setWeekcohortCount($this->getWeekcohortCount()+1);

            if ($value->getCreatedAt() == $endDate) {
                $chartData = $this->calculatePercentage(
                    $chartData,
                    $weekNo,
                    $this->getWeekcohortCount(),
                    $this->getFortyCount(),
                    $this->getFiftyCount(),
                    $this->getSeventyCount(),
                    $this->getNinetyCount(),
                    $this->getNinetynineCount(),
                    $this->getHundredCount()
                );

                $this->resetCohortData();
                $endDate = date('Y-m-d', strtotime('+1 week', strtotime($endDate)));
                $weekNo++;
            }
        }

        return $chartData;
    }

    private function initialChartData()
    {
        return [
            0 => ["week"],
            1 => ['40'],
            2 => ['50'],
            3 => ['70'],
            4 => ['90'],
            5 => ['99'],
            6 => ['100']
        ];
    }

    private function checkOnboardPercentage($onboardPercentages)
    {
        if ($onboardPercentages >= 40) {
            $this->setFortyCount($this->getFortyCount() + 1);
        }
        if ($onboardPercentages >= 50) {
            $this->setFiftyCount($this->getFiftyCount() + 1);
        }
        if ($onboardPercentages >= 70) {
            $this->setSeventyCount($this->getSeventyCount() + 1);

        }
        if ($onboardPercentages >= 90) {
            $this->setNinetyCount($this->getNinetyCount() + 1);
        }
        if ($onboardPercentages >= 99) {
            $this->setNinetynineCount($this->getNinetynineCount() + 1);
        }
        if ($onboardPercentages == 100) {
            $this->setHundredCount($this->getHundredCount() + 1);
        }
    }

    private function calculatePercentage(
        $chartData,
        $weekNo,
        $weekCohortCount,
        $fortyCount,
        $fiftyCount,
        $seventyCount,
        $ninetyCount,
        $ninetyNineCount,
        $hundredCount)
    {
        $chartData[0][] = $weekNo . " weeks later";
        $chartData[1][] = intval(($fortyCount / $weekCohortCount) * 100);
        $chartData[2][] = intval(($fiftyCount / $weekCohortCount) * 100);
        $chartData[3][] = intval(($seventyCount / $weekCohortCount) * 100);
        $chartData[4][] = intval(($ninetyCount / $weekCohortCount) * 100);
        $chartData[5][] = intval(($ninetyNineCount / $weekCohortCount) * 100);
        $chartData[6][] = intval(($hundredCount / $weekCohortCount) * 100);

        return $chartData;
    }

    private function resetCohortData()
    {
        $this->setFortyCount(0);
        $this->setFiftyCount(0);
        $this->setSeventyCount(0);
        $this->setNinetyCount(0);
        $this->setNinetynineCount(0);
        $this->setHundredCount(0);
        $this->setWeekcohortCount(0);
    }
}