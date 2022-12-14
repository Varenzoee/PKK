<?php
error_reporting(0);
@session_start();
if ($_SESSION['level'] == "") {
    session_destroy();
    header("location:login.php");
    exit();
}
