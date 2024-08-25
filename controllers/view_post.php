<?php
require_once('../model/Post.php');
session_start();
// show one post page

// the titele of page
$_SESSION['head_title'] = "view post";

// id of post
$post_id = $_GET['id'];
$_SESSION['post'] = Post::read($post_id);
header("Location: ../views/view_posts.php");