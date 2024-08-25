<?php
require_once('../model/Post.php');
require_once('../model/User.php');
session_start();
$saerch_key = $_SESSION['myPostsaerch'][0] ?? '';
$saerch_value = $_SESSION['myPostsaerch'][1] ?? '';

$_SESSION['head_title'] = "my posts";
$loginUser = $_SESSION['loginUser'];
$_SESSION['posts'] = Post::listMyPosts($loginUser->getId(), $saerch_key, $saerch_value);
$_SESSION['myPostsaerch'][0] = '';
$_SESSION['myPostsaerch'][1] = '';
header("Location: ../views/my_posts.php");