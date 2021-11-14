<?php

namespace onboard\model;


class Cohorts
{
    private $fileData, $userId, $createdAt, $onboardingPerentage, $countApplications, $countAcceptedApplications;

    private $fourtycout = 0;
    private $fiftycount = 0;
    private $seventycount = 0;
    private $ninetycount = 0;
    private $ninetyninecount = 0;
    private $hundredcount = 0;
    private $weekchortcount = 0;

    public function __construct($fileData)
    {
        $this->fileData = $fileData;
    }

    /**
     * @param mixed $fileData
     */
    public function setFileData($fileData)
    {
        $this->fileData = $fileData;
    }

    /**
     * @return mixed
     */
    public function getFileData()
    {
        return $this->fileData;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getOnboardingPerentage()
    {
        return $this->onboardingPerentage;
    }

    /**
     * @param mixed $onboardingPerentage
     */
    public function setOnboardingPerentage($onboardingPerentage)
    {
        $this->onboardingPerentage = $onboardingPerentage;
    }

    /**
     * @return mixed
     */
    public function getCountApplications()
    {
        return $this->countApplications;
    }

    /**
     * @param mixed $countApplications
     */
    public function setCountApplications($countApplications)
    {
        $this->countApplications = $countApplications;
    }

    /**
     * @return mixed
     */
    public function getCountAcceptedApplications()
    {
        return $this->countAcceptedApplications;
    }

    /**
     * @param mixed $countAcceptedApplications
     */
    public function setCountAcceptedApplications($countAcceptedApplications)
    {
        $this->countAcceptedApplications = $countAcceptedApplications;
    }

    public function getAll()
    {
        $count = 0;
        $dataArray = [];
        foreach ($this->fileData as $data) {
            if ($count > 0) {
                $dataArray[] = [
                    'user_id' => $data[0],
                    'created_at' => date('Y-m-d', strtotime($data[1])),
                    'onboarding_perentage' => $data[2],
                    'count_applications' => $data[3],
                    'count_accepted_applications' => $data[4]
                ];
            }
            $count++;
        }
        return $this->getSortdata($dataArray);
    }

    /**
     * sort data by created_at
     * @param $dataArray
     * @return mixed
     */
    public function getSortdata(&$dataArray)
    {

        usort($dataArray, array($this, "compareCreatedDate"));
        return $dataArray;
    }

    /**
     * Compare Created Date
     * @param $a
     * @param $b
     * @return int|\lt
     */
    public static function compareCreatedDate($a, $b)
    {
        return strcmp($a["created_at"], $b["created_at"]);
    }

    /**
     * Create Chart Data Array
     * @param $data
     * @return mixed|\string[][]
     */
    public function createChartData($data)
    {
        $weekno = 0;
        $chartdata = $this->initialChartData();
        $enddate = '';
        foreach ($data as $value) {
            if ($weekno == 0) {
                $startdate = $data[0]['created_at'];
                $enddate = date('Y-m-d', strtotime('+1 week', strtotime($startdate)));
            }
            if ($value['created_at'] < $enddate) {

                $this->checkOnboardingPerentage($value['onboarding_perentage']);
                $this->weekchortcount++;
            } else {
                $chartdata = $this->calculatePerentage($chartdata,
                    $weekno,
                    $this->weekchortcount,
                    $this->fourtycout,
                    $this->fiftycount,
                    $this->seventycount,
                    $this->ninetycount,
                    $this->ninetyninecount,
                    $this->hundredcount
                );
                $this->resetCohotData();
                $weekno++;
                $startdate = $enddate;
                $enddate = date('Y-m-d', strtotime('+1 week', strtotime($startdate)));
            }
        }

        return $chartdata;
    }

    /**
     * Calculate Perentage
     * @param $chartdata
     * @param $weekno
     * @param $weekchortcount
     * @param $fourtycout
     * @param $fiftycount
     * @param $seventycount
     * @param $ninetycount
     * @param $ninetyninecount
     * @param $hundredcount
     * @return mixed
     */
    public function calculatePerentage(
        $chartdata,
        $weekno,
        $weekchortcount,
        $fourtycout,
        $fiftycount,
        $seventycount,
        $ninetycount,
        $ninetyninecount,
        $hundredcount)
    {
        $chartdata[0][] = $weekno . " weeks later";
        $chartdata[1][] = intval(($fourtycout / $weekchortcount) * 100);
        $chartdata[2][] = intval(($fiftycount / $weekchortcount) * 100);
        $chartdata[3][] = intval(($seventycount / $weekchortcount) * 100);
        $chartdata[4][] = intval(($ninetycount / $weekchortcount) * 100);
        $chartdata[5][] = intval(($ninetyninecount / $weekchortcount) * 100);
        $chartdata[6][] = intval(($hundredcount / $weekchortcount) * 100);

        return $chartdata;
    }

    /**
     * Check Onboarding Perentage
     * @param $onboardingPerentage
     */
    public function checkOnboardingPerentage($onboardingPerentage)
    {

        if ($onboardingPerentage >= 40) {
            $this->fourtycout++;
        }
        if ($onboardingPerentage >= 50) {
            $this->fiftycount++;

        }
        if ($onboardingPerentage >= 70) {
            $this->seventycount++;

        }
        if ($onboardingPerentage >= 90) {
            $this->ninetycount++;

        }
        if ($onboardingPerentage >= 99) {
            $this->ninetyninecount++;
        }
        if ($onboardingPerentage == 100) {
            $this->hundredcount++;
        }
    }

    /**
     * Reset CohotData
     */
    public function resetCohotData()
    {
        $this->fourtycout = 0;
        $this->fiftycount = 0;
        $this->seventycount = 0;
        $this->ninetycount = 0;
        $this->ninetyninecount = 0;
        $this->hundredcount = 0;
        $this->weekchortcount = 0;
    }

    public function initialChartData()
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

}