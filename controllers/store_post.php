<?php
require_once('../model/Post.php');
require_once('../model/User.php');

session_start();
$loginUser = $_SESSION['loginUser'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // check if the input value is empty and show  validations messages

    if (empty($_POST['title'])   || empty($_POST['content'])) {
        if (empty($_POST['title'])) {
            $_SESSION['validations']['title'] = " please enter a title";
            $_SESSION['old_data']['title'] = "";
        } else {
            $_SESSION['validations']['title'] = "";
            $_SESSION['old_data']['title'] = $_POST['title'];
        }
        if (empty($_POST['content'])) {
            $_SESSION['validations']['content'] = " please enter a content";
            $_SESSION['old_data']['content'] = "";
        } else {
            $_SESSION['validations']['content'] = "";
            $_SESSION['old_data']['content'] = $_POST['content'];
        }
        header("Location: create_post.php");
        die();
    }

    Post::create($_POST['title'], $_POST['content'], $loginUser->getId());
    $_SESSION['messages'] = [
        'add' => "added successful",
    ];
    header("Location: index_post.php");
    die();
}