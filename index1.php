<?php
error_reporting(0);
@session_start();
include 'auth.php';
include 'siteinfo.php';
include 'func.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style type="text/css">
        #jdlats {
            font-size: 9pt;
        }

        @media(min-width:50em) {
            #jdlats {
                font-size: 16pt
            }
        }

        html {
            font-size: 60%;
        }

        @media(min-width:50em) {
            html {
                font-size: 8pt
            }
        }

        @media only screen and (max-width:480px) {
            #hidden-480 {
                display: none !important
            }
        }

        @media only screen and (max-width:320px) {
            #hidden-320 {
                display: none !important
            }
        }
    </style>
</head>

<body>
    <?php
    include "site_top_nav.php";
    ?>
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <?php
            include "site_side_nav.php";
            ?>
            <?php
            //alert
            if ($_SESSION['pesan'] != "") {
                echo '<script type="text/JavaScript">
                  alertify.' . $_SESSION['type'] . '("' . $_SESSION['pesan'] . '");
             </script>';
                unset($_SESSION['pesan'], $_SESSION['type']);
            }
            ?>
            <?php
            include "halaman.php";
            ?>
        </section>
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
</body>

</html>