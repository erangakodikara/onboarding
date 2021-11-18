<?php
namespace onboard\src\controller;

use onboard\src\controller\impl\HomeController;
use onboard\src\controller\impl\LoginController;
use onboard\src\controller\impl\SignupController;

require_once 'config/setting.php';

class MainController
{
    /**
     * Get Controller
     */
    public function getController()
    {
        if (isset($_GET["controller"])) {
            // Load the instance of the corresponding controller.
            $controllerObj = $this->changeController($_GET["controller"]);
            //Launch the action
            $this->launchAction($controllerObj);
        } else {
            // Load the default controller instance.
            $controllerObj = $this->changeController(CONTROLLER_DEFECTO);
            // Launch the action.
            $this->launchAction($controllerObj);
        }
    }

    /**
     * Change Controller
     * @param $controller
     * @return HomeController|SignupController|LoginController
     */
    private function changeController($controller)
    {
        switch ($controller) {
            case 'home':
                require_once 'src/controller/impl/HomeController.php';
                $controllerObj = new HomeController();
                break;
            case 'signup':
                require_once 'src/controller/impl/SignupController.php';
                $controllerObj = new SignupController();
                break;
            default:
                require_once 'src/controller/impl/LoginController.php';
                $controllerObj = new LoginController();
                break;
        }
        return $controllerObj;
    }

    /**
     * Launch Action
     * @param $controllerObj
     */
    private function launchAction($controllerObj)
    {
        if (isset($_GET["action"])) {
            $controllerObj->run($_GET["action"]);
        } else {
            $controllerObj->run(DEFECT_ACTION);
        }
    }
}