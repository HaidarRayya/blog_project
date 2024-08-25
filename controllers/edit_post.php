<?php
require_once('../model/Post.php');
session_start();

$_SESSION['head_title'] = "edit post";

$id = $_GET['id'] ?? $_SESSION['edit_id'];
$_SESSION['post'] = Post::read($id);
header("Location: ../views/edit_posts.php");