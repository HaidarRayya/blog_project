<?php
require_once('../model/Post.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['id'])) {
        header("Location: index_post.php");
    }
    Post::delete($_POST['id']);
    $_SESSION['messages'] = [
        'delete' => "deleted successful",
    ];
    header("Location: index_post.php");
}
