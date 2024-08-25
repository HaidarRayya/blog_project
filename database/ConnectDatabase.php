<?php
require_once('Database.php');

// use the singleton principle to create one variable to connect with database
// check if the variable  null to  create it  and return the variable 
class ConnectDatabase
{
    private static $database;
    public static function connectDatabae()
    {
        if (self::$database == null) {
            self::$database = new Database();
        }
        return self::$database;
    }
}