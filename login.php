<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'siteinfo.php';
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box ">
        <!-- /.login-logo -->
        <div class="card card-outline card-sekunder">
            <header class="panel heading">
                <a href="" class="logo">
                    <!-- <div style="float: left">
                        <img src="assets/logo/logo.png" height="85" alt="" srcset="">
                    </div> -->

                    <div style="padding-left: 60px;padding-top: 10px;color: primary;">
                        <font size="4px"><strong><?php echo strtoupper($data_info['nama_aplikasi']); ?></font></strong>
                    </div>
                    <div style="padding-left: 30px;color: primary; ">
                        <font size="3,5px"><strong><?php echo strtoupper($data_info['nama_instansi']); ?></font></strong>
                    </div>
                </a>
            </header>
            <div class="card-body ">


                <form action="proses/proslogin.php" method="post" id="formlogin">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sx-12">
                        <!-- /.col -->
                        <div class="btn btn-block btn-primary">
                            <button type="submit" class="btn btn-primary btn-block" name="Logon" id="logon">LOGIN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script>
        $(document).ready(function() {
            $('#formlogin').keypress(function(event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    $("#logon").click();
                }
            });

            $("#logon").click(function() {
                $.blockUI({
                    message: '<h4><img src="images/loading.gif" /> cek login...</h4>'
                });
                var datas = $("#formlogin").serializeArray();
                $.post(
                    'proses/proslogin.php',
                    datas,
                    function(data) {
                        if (data[0] == 'ok') {
                            $(location).attr('href', 'index.php');
                        }
                        /*else if(data[0] == 'absen'){
                           $(location).attr('href','halaman_absen.php');
                        }*/
                        else if (data[0] == 'err') {
                            $.unblockUI();
                            $(".blockUI").fadeOut("slow");
                            alertify.error(data[3]);
                        } else {
                            $.unblockUI();
                            $(".blockUI").fadeOut("slow");
                            alert("sistem error");
                        }
                    }, 'json');

            });
        });

        $(window).load(function() {
            var i = 0;
            var images = ['deep-green.jpg', 'ocean.jpg', 'color-splash.jpg', 'aqua.jpg'];
            var image = $('#fullscreen_bg');
            //Initial Background image setup
            image.css('background-image', 'url(images/aqua.jpg)');
            //Change image at regular intervals
            setInterval(function() {
                image.fadeOut(500, function() {
                    image.css('background-image', 'url(images/' + images[i++] + ')');
                    image.fadeIn(1000);
                });
                if (i == images.length)
                    i = 0;
            }, 10000);
        });
    </script>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>