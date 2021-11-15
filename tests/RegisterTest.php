<?php


use onboard\core\conectar;
use onboard\model\Register;
use PHPUnit\Framework\TestCase;

/**
 * Class RegisterTest
 */
class RegisterTest extends TestCase
{
    private $conectar;
    private $db;
    private $model;

    /**
     * Setup.
     */
    public function setUp()
    {
        require_once __DIR__ . "/../core/conectar.php";
        require_once __DIR__ . "/../model/register.php";

        $this->conectar = new conectar();
        $this->db = $this->conectar->dbConector();
        $this->model = new Register($this->db);
    }

    /**
     *  test GetId
     */
    public function testGetId()
    {
        $this->model->setId(122);
        $this->assertSame(122, $this->model->getId());
    }

    /**
     * test SetId
     */
    public function testSetId()
    {
        $this->model->setId(122);
        $this->assertSame(122, $this->model->getId());
    }

    /**
     * test GetUsername
     */
    public function testGetUsername()
    {
        $this->model->setUsername("test user");
        $this->assertSame("test user", $this->model->getUsername());
    }


    /**
     * test SetUsername
     */
    public function testSetUsername()
    {
        $this->model->setUsername("wedwedzd");
        $this->assertSame("wedwedzd", $this->model->getUsername());
    }

    /**
     * test SetPassword
     */
    public function testSetPassword()
    {
        $this->model->setPassword("wedwedzd");
        $this->assertSame("wedwedzd", $this->model->getPassword());
    }

    /**
     * test GetPassword
     */
    public function testGetPassword()
    {
        $this->model->setPassword("wedwedzd");
        $this->assertSame("wedwedzd", $this->model->getPassword());
    }

    /**
     * test GetDb
     */
    public function testGetDb()
    {
        $this->model->setDb("testdb");
        $this->assertSame("testdb", $this->model->getDb());
    }

    /**
     * test SetDb
     */
    public function testSetDb()
    {
        $this->model->setDb("testdb");
        $this->assertSame("testdb", $this->model->getDb());
    }

    /**
     * test SetTable
     */
    public function testSetTable()
    {
        $this->model->setTable("testtable");
        $this->assertSame("testtable", $this->model->getTable());
    }

    /**
     * test GetTable
     */
    public function testGetTable()
    {
        $this->model->setTable("testtable");
        $this->assertSame("testtable", $this->model->getTable());
    }

    /**
     * test SetEmail
     */
    public function testSetEmail()
    {
        $this->model->setEmail("test@gmail.com");
        $this->assertSame("test@gmail.com", $this->model->getEmail());
    }

    /**
     * test GetEmail
     */
    public function testGetEmail()
    {
        $this->model->setEmail("test@gmail.com");
        $this->assertSame("test@gmail.com", $this->model->getEmail());
    }
}

