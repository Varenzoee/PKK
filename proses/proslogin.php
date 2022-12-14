<?php
include '../konek.php';
error_reporting(0);
@session_start();

$User = $_POST['Username'];
$pass = $_POST['Password'];

$sql = "SELECT * from t_user where username='$User' and password='$pass'";
$login = mysqli_query($db_li, $sql);

echo $sql;
$cek = mysqli_num_rows($login);
echo $cek;
echo ('selamatt');

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);
    if ($data['hak_akses'] == 0) {
        $_SESSION['Username'] = $User;
        $_SESSION['hak_akses'] = 0;

        header("location:../site_top_nav.php");
    } else if ($data['hak_akses'] == 1) {

        $_SESSION['Username'] = $User;
        $_SESSION['hak_akses'] = 0;

        header("location:../site_side_nav.php");
    }
} else {
    header("location:../login.php");
}
