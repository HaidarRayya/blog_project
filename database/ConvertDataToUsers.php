<?php
require_once('../model/User.php');
class ConvertDataToUsers
{
    // convert one record from users table to user object 
    public static function convertOneUser($data)
    {
        $data = $data->fetch(PDO::FETCH_OBJ);

        $user = new User($data->id, $data->firstname, $data->lastname, $data->email, $data->password, $data->created_at, $data->updated_at);
        return $user;
    }
}