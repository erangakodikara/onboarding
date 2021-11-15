<?php

use onboard\core\conectar;
use onboard\model\Cohorts;
use PHPUnit\Framework\TestCase;

/**
 * Class CohortsTest
 */
class CohortsTest extends TestCase
{
    private $conectar;
    private $fileData;
    private $cohorts;

    /**
     * Setup.
     */
    public function setUp()
    {
        require_once __DIR__ . "/../core/conectar.php";
        $this->conectar = new conectar();
        $this->fileData = $this->conectar->csvFileConector();
        $this->cohorts = new Cohorts($this->fileData);

    }

    /**
     * test SetOnboardingPerentage
     */
    public function testSetOnboardingPerentage()
    {
        $this->cohorts->setOnboardingPerentage(40);
        $this->assertSame(40, $this->cohorts->getOnboardingPerentage());

    }

    /**
     * test GetOnboardingPerentage
     */
    public function testGetOnboardingPerentage()
    {
        $this->cohorts->setOnboardingPerentage(40);
        $this->assertSame(40, $this->cohorts->getOnboardingPerentage());
    }

    /**
     * test SetCountAcceptedApplications
     */
    public function testSetCountAcceptedApplications()
    {
        $this->cohorts->setCountAcceptedApplications(5);
        $this->assertSame(5, $this->cohorts->getCountAcceptedApplications());
    }

    /**
     * test GetCountAcceptedApplications
     */
    public function testGetCountAcceptedApplications()
    {
        $this->cohorts->setCountAcceptedApplications(3);
        $this->assertSame(3, $this->cohorts->getCountAcceptedApplications());
    }

    /**
     * test SetFileData
     */
    public function testSetFileData()
    {
        $this->cohorts->setFileData($this->fileData);
        $this->assertSame($this->fileData, $this->cohorts->getFileData());
    }

    /**
     * test GetFileData
     */
    public function testGetFileData()
    {
        $this->cohorts->setFileData($this->fileData);
        $this->assertSame($this->fileData, $this->cohorts->getFileData());
    }

    /**
     * test SetCreatedAt
     */
    public function testSetCreatedAt()
    {
        $this->cohorts->setCreatedAt('2021-11-11');
        $this->assertSame('2021-11-11', $this->cohorts->getCreatedAt());
    }

    /**
     * test GetCreatedAt
     */
    public function testGetCreatedAt()
    {
        $this->cohorts->setCreatedAt('2021-11-11');
        $this->assertSame('2021-11-11', $this->cohorts->getCreatedAt());
    }

    /**
     * test SetCountApplications
     */
    public function testSetCountApplications()
    {
        $this->cohorts->setCountApplications(6);
        $this->assertSame(6, $this->cohorts->getCountApplications());
    }

    /**
     * test GetCountApplications
     */
    public function testGetCountApplications()
    {
        $this->cohorts->setCountApplications(6);
        $this->assertSame(6, $this->cohorts->getCountApplications());
    }

    /**
     * test SetUserId
     */
    public function testSetUserId()
    {
        $this->cohorts->setUserId(32131);
        $this->assertSame(32131, $this->cohorts->getUserId());
    }

    /**
     * test GetUserId
     */
    public function testGetUserId()
    {
        $this->cohorts->setUserId(32131);
        $this->assertSame(32131, $this->cohorts->getUserId());
    }
}

