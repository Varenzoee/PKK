<?php 
error_reporting(0);
@session_start();
include 'konek.php';

$sql = "select * from t_config LIMIT 1";
$result = $db_li->query($sql);
$data_info = $result->fetch_assoc();
$result->close();
