<?php

use onboard\controller\chartController;
use onboard\controller\loginController;
use onboard\controller\signupController;

require_once 'config/setting.php';
session_start();

// Load the controller and execute the action.
if (isset($_GET["controller"])) {
    // Load the instance of the corresponding controller.
    $controllerObj = changeControlador($_GET["controller"]);
    //Launch the action
    launchAction($controllerObj);
} else {
    // Load the default controller instance.
    $controllerObj = changeControlador(CONTROLLER_DEFECTO);
    // Launch the action.
    launchAction($controllerObj);
}

/**
 * @param $controller
 * @return chartController
 */
function changeControlador($controller)
{
    switch ($controller) {
        case 'home':
            $strFileController = 'controller/chartController.php';
            require_once $strFileController;
            $controllerObj = new chartController();
            return $controllerObj;
            break;
        case 'signup':
            $strFileController = 'controller/signupController.php';
            require_once $strFileController;
            $controllerObj = new signupController();
            return $controllerObj;
            break;
        default:
            $strFileController = 'controller/loginController.php';
            require_once $strFileController;
            $controllerObj = new loginController();
            break;
    }
    return $controllerObj;
}

/**
 * @param $controllerObj
 */
function launchAction($controllerObj)
{
    if (isset($_GET["action"])) {
        $controllerObj->run($_GET["action"]);
    } else {
        $controllerObj->run(DEFECT_ACTION);
    }
}