<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="<?php echo base_url('themes/inspinia/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('themes/inspinia/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url('themes/inspinia/'); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('themes/inspinia/'); ?>css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <!-- <h1 class="logo-name">IN+</h1> -->
                <img src="<?php echo base_url(); ?>/assets/images/logo_pn.png" width="250px" class="logo-name">

            </div>
            <h3>Sistem Informasi Persuratan</h3>
            
            <form class="m-t" role="form" action="<?php echo base_url('login') ?>" method="post">
                <div class="form-group">
                    <input type="text" name="identity" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <p class="text-right">
                    <label for="remember">Remember Me:</label>    <input type="checkbox" name="remember" value="1"  id="remember" />
                </p>
                <?php echo $message ?>
                <a href="#"><small>Lupa password?</small></a>

                <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p> -->
                <!--   <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url('themes/inspinia/'); ?>register.html">Create an account</a> -->
            </form>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('themes/inspinia/'); ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url('themes/inspinia/'); ?>js/bootstrap.min.js"></script>

</body>

</html>
