<?php

namespace onboard\controller;

use onboard\core\conectar;
use onboard\model\Cohorts;

/**
 * Class chartController
 * @package onboard\controller
 */
class chartController
{
    private $conectar;
    private $fileData;
    private $db;

    /**
     * chartController constructor.
     */
    public function __construct()
    {
        require_once __DIR__ . "/../core/conectar.php";
        require_once __DIR__ . "/../model/cohorts.php";

        $this->conectar = new conectar();
        $this->db = $this->conectar->dbConector();
        $this->fileData = $this->conectar->csvFileConector();
    }

    /**
     * execute the corresponding action
     *
     */
    public function run($accion)
    {
        switch ($accion) {
            case "home" :
                $this->home();
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
        //Create the Cohorts object.
        $cohorts = new Cohorts($this->fileData);

        //Get all the Cohorts.
        $cohortsData = $cohorts->getAll();

        $chartdata = $cohorts->createChartData($cohortsData);
        //Load the index view and pass values to it.
        $this->view("index", array(
            "cohorts" => $cohortsData,
            'chatdata' => $chartdata
        ));
    }

    /**
     * Home
     */
    public function home()
    {
        //Create the Cohorts object.
        $cohorts = new Cohorts($this->fileData);

        //Get all the Cohorts
        $cohortsData = $cohorts->getAll();

        $chartdata = $cohorts->createChartData($cohortsData);
        //Load the index view and pass values to it.
        $this->view("home", array(
            "cohorts" => $cohortsData,
            'chatdata' => $chartdata
        ));
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