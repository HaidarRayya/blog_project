<?php
session_start();
if (isset($_POST['myPost'])) {
    $saerch_key = array_key_first($_POST);
    $saerch_value = $_POST[$saerch_key];
    $_SESSION['myPostsaerch'] = [
        $saerch_key,
        $saerch_value
    ];

    header("Location: my_posts.php");
} else {
    $saerch_key = array_key_first($_POST);
    $saerch_value = $_POST[$saerch_key];
    $_SESSION['saerch'] = [
        $saerch_key,
        $saerch_value
    ];
    header("Location: index_post.php");
}