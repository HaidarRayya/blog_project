<?php
require_once('../database/ConnectDatabase.php');
require_once('../database/ConvertDataToUsers.php');

class User
{
    private int $id;
    private String $firstName;
    private String $lastName;
    private String $email;
    private String $password;
    private $created_at;
    private $updated_at;


    public function __construct($id, $firstName, $lastName, $email, $password, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getUpdated_at()
    {
        return $this->updated_at;
    }
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }


    //login 
    public static function login($email, $password)
    {
        $password = md5($password);

        $sql = "SELECT * FROM blog_db.users WHERE email='$email' and password='$password' limit 1";
        $user = ConnectDatabase::connectDatabae()->query($sql);
        return ConvertDataToUsers::convertOneUser($user);
    }

    // regitser a new account
    public static function register($firstName, $lastName, $email, $password)
    {
        $password = md5($password);

        $sql = "INSERT INTO blog_db.users(firstname,lastname,email,password)
        VALUES ('$firstName','$lastName','$email','$password');";
        $user = ConnectDatabase::connectDatabae()->query($sql);

        $sql = "SELECT * FROM blog_db.users WHERE email='$email' && password='$password' limit 1";
        $user = ConnectDatabase::connectDatabae()->query($sql);
        return ConvertDataToUsers::convertOneUser($user);
    }
    //check if email is existing

    public static function checkEmails($email)
    {

        $sql = "SELECT * FROM blog_db.users WHERE email='$email' ;";
        $data = ConnectDatabase::connectDatabae()->query($sql);
        $rows = $data->fetchAll();
        $rowCount = count($rows);
        if ($rowCount >= 1) {
            return false;
        } else {
            return true;
        }
    }
    //check if user login data is existing
    public static function checkloginData($email, $password)
    {
        $password = md5($password);

        $sql = "SELECT * FROM blog_db.users WHERE email='$email' and password='$password'";
        $data = ConnectDatabase::connectDatabae()->query($sql);
        $rows = $data->fetchAll();
        $rowCount = count($rows);
        if ($rowCount == 1) {
            return true;
        } else {
            return false;
        }
    }
}