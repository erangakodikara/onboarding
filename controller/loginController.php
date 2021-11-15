<?php

namespace onboard\controller;

use onboard\core\conectar;
use onboard\model\Register;

/**
 * Class loginController
 * @package onboard\controller
 */
class loginController
{
    private $conectar;
    private $db;
    private $model;


    /**
     * loginController constructor.
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

    /**
     * Login
     */
    public function index()
    {
        $this->view("index", []);
    }

    /**
     * Login
     */
    public function login()
    {
        $this->model->login();
        if ($_SESSION['loggedIn']) {

            header('location: index.php?controller=home&action=chart');
        } else {
            $this->view("index", []);
        }
    }

    /**
     * logout
     */
    public function logout()
    {
        session_destroy();
        header('location: index.php');
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
