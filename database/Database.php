<?php

class Database
{
    public $connection;

    // create a  object to use to connect with database
    // if there are errors print them and ending every thing
    public function __construct()
    {
        try {
            $conn = "mysql:host=localhost";
            $this->connection = new PDO($conn, 'root', '1234');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }
    // execute the query and return the result
    // if there are errors print them and ending every thing

    public function query($query)
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();
            return  $statement;
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }
}
