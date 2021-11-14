<?php

use onboard\controller\chartController;

require_once 'config/setting.php';

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
    $strFileController = 'controller/chartController.php';
    require_once $strFileController;
    $controllerObj = new chartController();
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