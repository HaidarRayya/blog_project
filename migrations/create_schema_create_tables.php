<?php
require_once('../database/Database.php');
// cretae a varibale to connect with database
$database = new Database();
try {
    // create the scheema  blog_db
    $sql = "CREATE DATABASE blog_db";

    // execute the query
    $database->query($sql);

    // create the table  users
    $sql = "CREATE TABLE blog_db.users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
    // execute the query
    $database->query($sql);
    // create the table  posts

    $sql = "CREATE TABLE blog_db.posts(
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT NOT NULL ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FOREIGN KEY(user_id) REFERENCES users(id)
);";
    // execute the query
    $database->query($sql);
} catch (PDOException $e) {
    print($e->getMessage());
    die();
}
$database = null;