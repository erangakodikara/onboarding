<?php
namespace onboard\src\dto;

class InterviewDTO
{

    private $userId;
    private $createdAt;
    private $onboardPercentage;
    private $countApplications;
    private $countAcceptedApplications;

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
    public function getOnboardPercentage()
    {
        return $this->onboardPercentage;
    }

    /**
     * @param mixed $onboardPercentage
     */
    public function setOnboardPercentage($onboardPercentage)
    {
        $this->onboardPercentage = $onboardPercentage;
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
}
