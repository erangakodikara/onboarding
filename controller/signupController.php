<?php

namespace onboard\controller;

use onboard\core\conectar;
use onboard\model\Register;

/**
 * Class signupController
 * @package onboard\controller
 */
class signupController
{
    private $conectar;
    private $model;
    private $db;

    /**
     * signupController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        require_once __DIR__ . "/../core/conectar.php";
        require_once __DIR__ . "/../model/register.php";

        $this->conectar = new conectar();
        $this->db = $this->conectar->dbConector();
        $this->model = new Register($this->db);

    }

    /**
     * execute the corresponding action
     *
     */
    public function run($accion)
    {
        switch ($accion) {
            case "save" :
                $this->signup();
                break;
            default:
                $this->index();
                break;
        }
    }

    /**
     * Index
     */
    public function index()
    {
        $this->view("signup", array());
    }

    /**
     * Signup
     */
    public function signup()
    {
        if (isset($_POST["user_name"]) && isset($_POST["password"]) && isset($_POST['email_id'])) {
            $userName = $_POST['user_name'];
            $password = md5($_POST['password']);
            $emailId = $_POST['email_id'];
            $count = $this->model->check_user($userName, $emailId);
            if ($count > 0) {
                echo 'This User Already Exists';
            } else {
                $data = [
                    'user_name' => $userName,
                    'email_id' => $emailId,
                    'password' => $password
                ];

                $this->model->insert_user($data);
            }
        }

        $this->view("index", []);
    }

    /**
     * @param $vista
     * @param $datos
     */
    public function view($vista, $datos)
    {
        $data = $datos;
        require_once __DIR__ . "/../view/" . $vista . "View.php";
    }

}