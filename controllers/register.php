<?php
session_start();

require_once('../model/User.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['firstName']) || empty($_POST['lastName'])  || empty($_POST['email']) || empty($_POST['password'])) {
        if (empty($_POST['firstName'])) {
            $_SESSION['validations']['firstName'] = " please enter a firstName";
            $_SESSION['old_data']['firstName'] = "";
        } else {
            $_SESSION['validations']['firstName'] = "";
            $_SESSION['old_data']['firstName'] = $_POST['firstName'];
        }
        if (empty($_POST['lastName'])) {
            $_SESSION['validations']['lastName'] = " please enter a lastName";
            $_SESSION['old_data']['lastName'] = "";
        } else {
            $_SESSION['validations']['lastName'] = "";
            $_SESSION['old_data']['lastName'] = $_POST['lastName'];
        }
        if (empty($_POST['email'])) {
            $_SESSION['validations']['email'] = " please enter a email";
            $_SESSION['old_data']['email'] = "";
        } else {
            $_SESSION['validations']['email'] = "";
            $_SESSION['old_data']['email'] = $_POST['email'];
        }
        if (empty($_POST['password'])) {
            $_SESSION['validations']['password'] = " please enter a password";
        } else {
            $_SESSION['validations']['password'] = "";
        }

        if (!empty($_POST['email']))
            if (User::checkEmails($_POST['email'])) {
                $_SESSION['validations']['email'] = "";
                $_SESSION['old_data']['email'] = $_POST['email'];
            }
        header("Location: ../register.php");
        die();
    }

    $user = User::register($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password']);
    $_SESSION['loginUser'] = $user;

    header("Location: index_post.php");
    die();
}