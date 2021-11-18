<?php

namespace onboard\src\controller\impl;

require_once 'src/controller/BaseControllerI.php';
require_once 'src/dao/data/impl/RegisterDao.php';
require_once 'src/dto/RegisterDTO.php';

use onboard\dao\data\impl\RegisterDao;
use onboard\src\controller\BaseControllerI;
use onboard\src\dto\RegisterDTO;


/**
 * Class LoginController
 * @package onboard\src\controller\impl
 */
class LoginController implements BaseControllerI
{
    /**
     * LoginController constructor.
     */
    public function __construct()
    {

    }

    public function index()
    {
        $this->view("index", array(
            'error' => '',
            'success' => '',
        ));
    }

    public function run($action)
    {
        switch ($action) {
            case "login" :
                $this->login();
                break;
            case "logout" :
                $this->logout();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function login()
    {
        $error = '';
        $success = '';
        if (isset($_POST["user_name"]) && isset($_POST["password"])) {
            $registerService = new RegisterDao();

            $userName = $_POST['user_name'];
            $password = md5($_POST['password']);

            $registerDTO  =  new RegisterDTO();
            $registerDTO->setUserName($userName);
            $registerDTO->setPassword($password);

            $registerService->login($registerDTO);
            if ($_SESSION['loggedIn']) {
                header('location: index.php?controller=home&action=chart');
            } else {


                $error =  "Incorrect User Name or Password";

            }

        } else {

            $error =  "Incorrect User Name or Password";

        }

        $this->view("index", array(
            'error' => $error,
            'success' => $success,
        ));

    }

    public function logout()
    {
        session_destroy();
        header('location: index.php');
    }

    public function view($view, $data)
    {
        $data = $data;
        require_once __DIR__ . "/../../../view/" . $view . "View.php";
    }
}