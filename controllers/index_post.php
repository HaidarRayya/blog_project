<?php
require_once('../model/Post.php');
session_start();

$saerch_key = $_SESSION['saerch'][0] ?? '';
$saerch_value = $_SESSION['saerch'][1] ?? '';


$_SESSION['head_title'] = "posts";
$_SESSION['posts'] = Post::listAll($saerch_key, $saerch_value);
$_SESSION['saerch'][0] = '';
$_SESSION['saerch'][1] = '';
header("Location: ../views/list_posts.php");