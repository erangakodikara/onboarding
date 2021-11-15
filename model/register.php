<?php

namespace onboard\model;

/**
 * Class Register
 * @package onboard\model
 */
class Register
{
    private $table = "register";
    private $db;
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
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
