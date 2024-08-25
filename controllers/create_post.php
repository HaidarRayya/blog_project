<?php
session_start();

$_SESSION['head_title'] = "create post";

header("Location: ../views/create_posts.php");