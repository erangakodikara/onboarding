<?php

session_start();

require_once 'src/controller/MainController.php';

use onboard\src\controller\MainController;

$mainController =  new MainController();
$mainController->getController();
