<?php
namespace onboard\src\controller\impl;

use onboard\dao\data\impl\RegisterDao;
use onboard\src\controller\BaseControllerI;
use onboard\src\dto\RegisterDTO;

require_once 'src/controller/BaseControllerI.php';
require_once 'src/dao/data/impl/RegisterDao.php';
require_once 'src/dto/RegisterDTO.php';

class SignupController implements BaseControllerI
{
    public function index()
    {
        $this->view("signup", array(
            'error' => '',
            'success' => '',
        ));
    }

    public function run($action)
    {
        switch ($action) {
            case "save" :
                $this->signup();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function signup(){

        $registerService = new RegisterDao();
        $error = '';
        $success = '';

        if (isset($_POST["user_name"]) && isset($_POST["password"]) && isset($_POST['email_id'])) {
            $userName = $_POST['user_name'];
            $password = md5($_POST['password']);
            $emailId = $_POST['email_id'];

            $registerDTO  =  new RegisterDTO();
            $registerDTO->setUserName($userName);
            $registerDTO->setEmail($emailId);
            $registerDTO->setPassword($password);
            $count = $registerService->checkUser($registerDTO);
            if ($count > 0) {
                $error = "This User Already Exists";
            } else {
                $registerService->insertUser($registerDTO);
                $success = "User successfully registered";
            }
        }

        $this->view("signup", array(
            'error' => $error,
            'success' => $success,
        ));
    }

    public function view($view, $data)
    {
        $data = $data;
        require_once __DIR__ . "/../../../view/" . $view . "View.php";
    }
}