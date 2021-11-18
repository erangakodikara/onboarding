<?php

namespace onboard\src\controller\impl;

use onboard\src\controller\BaseControllerI;
use onboard\src\service\impl\ChartService;

require_once 'src/controller/BaseControllerI.php';
require_once 'src/service/impl/ChartService.php';

class HomeController implements BaseControllerI
{

    public function index()
    {
        if ($_SESSION['loggedIn']) {

            $chartService = new ChartService();
            $chartData = $chartService->getChartData();

            $this->view("home", array(
                'chatData' => $chartData
            ));
        } else {
            header('location: index.php');
        }
    }

    public function run($action)
    {
        switch ($action) {
            case "chart" :
                $this->home();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function home()
    {
        if ($_SESSION['loggedIn']) {
        $chartService = new ChartService();
        $chartData = $chartService->getChartData();

            $this->view("home", array(
                'chatData' => $chartData
            ));
        } else {
            header('location: index.php');
        }
    }

    public function view($view, $data)
    {
        $data = $data;
        require_once __DIR__ . "/../../../view/" . $view . "View.php";
    }
}