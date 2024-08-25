<?php
require_once('../model/Post.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // check if the input value is empty and show  validations messages
    if (empty($_POST['title'])   || empty($_POST['content'])) {
        $_SESSION['validations'] = [
            'title' => " please enter a title",
            'content' => " please enter a content"
        ];
        $_SESSION['edit_id'] = $_POST['id'];
        header("Location: edit_post.php");
        die();
    }

    Post::update($_POST['id'], $_POST['title'], $_POST['content']);
    $_SESSION['messages'] = [
        'update' => "updated successful",
    ];
    header("Location: index_post.php");
}