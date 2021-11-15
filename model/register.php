<?php

namespace onboard\model;

/**
 * Class Register
 * @package onboard\model
 */
class Register
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * check_user
     * @param $userName
     * @param $emailId
     * @return int
     */
    public function check_user($userName, $emailId)
    {
        $consultation = $this->db->prepare("SELECT * FROM register WHERE user_name = :user_name OR email_id = :email_id ");
        $consultation->execute([
            'user_name' => $userName,
            'email_id' => $emailId
        ]);

        /* Fetch all of the remaining rows in the result set */
        $result = $consultation->fetchAll();
        $count = count($result);
        return $count;
    }

    /**
     * insert_user
     * @param $data
     * @return mixed
     */
    public function insert_user($data)
    {
        $consultation = $this->db->prepare("INSERT INTO register (user_name, email_id, password) VALUES (:user_name, :email_id, :password) ");
        $result = $consultation->execute($data);
        return $result;
    }

    /**
     * login
     */
    public function login()
    {
        if (isset($_POST["user_name"]) && isset($_POST["password"])) {
            $userName = $_POST['user_name'];
            $password = md5($_POST['password']);

            $consultation = $this->db->prepare("SELECT * FROM register WHERE user_name = :user_name and password = :password ");
            $consultation->execute([
                'user_name' => $userName,
                'password' => $password
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
}