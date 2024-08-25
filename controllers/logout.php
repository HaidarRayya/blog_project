<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $_SESSION['loginUser'] = '';

    header("Location: ../index.php");
    die();
}
