<?php

require_once 'src/dao/data/impl/RegisterDao.php';
require_once 'src/dto/RegisterDTO.php';
use onboard\dao\data\impl\RegisterDao;
use onboard\src\dto\RegisterDTO;

class RegisterDaoTest extends \PHPUnit\Framework\TestCase
{
private $registerService;
    public function setUp(): void
    {
        parent::setUp();
        $this->registerService = new RegisterDao();
    }

    public function testInsertUser()
    {
        $this->registerService = new RegisterDao();
        $registerDTO = new RegisterDTO();
        $registerDTO->setUserName('test user1'.time());
        $registerDTO->setEmail('testuser1'.time().'@gamil.com');
        $registerDTO->setPassword("223#7721*66");
        $result = $this->registerService->insertUser($registerDTO);

        $this->assertTrue($result);
        $this->assertSame(true,$result);

    }

    public function testCheckUser()
    {

        $registerDTO = new RegisterDTO();
        $registerDTO->setUserName('test user12' . time());
        $registerDTO->setEmail('testuser12' . time() . '@gamil.com');
        $registerDTO->setPassword("223#7721*66");
        $result = $this->registerService->insertUser($registerDTO);

        $this->assertTrue($result);

        $userCount = $this->registerService->checkUser($registerDTO);
        $this->assertSame(1, $userCount);

    }

    public function testLogin()
    {
        $this->registerService = new RegisterDao();
        $registerDTO = new RegisterDTO();
        $registerDTO->setUserName('test user13' . time());
        $registerDTO->setEmail('testuser13' . time() . '@gamil.com');
        $registerDTO->setPassword("223#7721*66");
        $result = $this->registerService->insertUser($registerDTO);

        $this->assertTrue($result);

        $this->registerService->login($registerDTO);
        $this->assertTrue( $_SESSION['loggedIn']);
        $this->assertSame('admin', $_SESSION['role']);

    }

}