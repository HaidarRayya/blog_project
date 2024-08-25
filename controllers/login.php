<?php
session_start();

require_once('../model/User.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['email']) || empty($_POST['password'])) {
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

        header("Location: ../index.php");
        die();
    }
    if (!User::checkloginData($_POST['email'], $_POST['password'])) {
        $_SESSION['messages'] = [
            'login' => "invalid data",
        ];
        header("Location: ../index.php");
        die();
    }
    $user = User::login($_POST['email'], $_POST['password']);
    $_SESSION['loginUser'] = $user;

    header("Location: index_post.php");
    die();
}
