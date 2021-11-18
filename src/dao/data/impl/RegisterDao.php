<?php


namespace onboard\dao\data\impl;
require_once 'src/dao/db/impl/DBConnector.php';

use onboard\dao\db\impl\DBConnector;
use onboard\src\dto\RegisterDTO;

class RegisterDao
{

    private $db;

    public function __construct()
    {
        $connector = new DBConnector();
        try {
            $this->db = $connector->dataConnector();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }


    /**
     * check_user
     * @param RegisterDTO $registerDTO
     * @return int
     */
    public function checkUser(RegisterDTO $registerDTO)
    {
        $consultation = $this->db->prepare("SELECT * FROM register WHERE user_name = :user_name OR email_id = :email_id ");
        $consultation->execute([
            'user_name' =>$registerDTO->getUserName(),
            'email_id' => $registerDTO->getEmail(),
        ]);

        /* Fetch all of the remaining rows in the result set */
        $result = $consultation->fetchAll();
        return count($result);
    }

    /**
     * insert_user
     * @param RegisterDTO $registerDTO
     * @return mixed
     */
    public function insertUser(RegisterDTO $registerDTO)
    {
        $consultation = $this->db->prepare("INSERT INTO register (user_name, email_id, password) VALUES (:user_name, :email_id, :password) ");
        return $consultation->execute([
            'user_name' => $registerDTO->getUserName(),
            'email_id' => $registerDTO->getEmail(),
            'password' => $registerDTO->getPassword()
        ]);
    }

    /**
     * login
     * @param RegisterDTO $registerDTO
     */
    public function login(RegisterDTO $registerDTO)
    {
        $consultation = $this->db->prepare("SELECT * FROM register WHERE user_name = :user_name and password = :password ");
        $consultation->execute([
            'user_name' => $registerDTO->getUserName(),
            'password' => $registerDTO->getPassword()
        ]);
        $result = $consultation->fetchAll();

        $count = count($result);

        if ($count > 0) {
            $_SESSION['role'] = "admin";
            $_SESSION['loggedIn'] = true;

        } else {
            $_SESSION['loggedIn'] = false;
        }
    }
}