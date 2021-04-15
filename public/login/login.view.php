<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title><?php echo APP_NAME; ?></title>
    <link rel="shortcut icon" href="<?php echo APP_FAVICON; ?>" type="image/png">

    <!-- vendor css -->
    <link href="media/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="media/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="media/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="media/css/azia.css">

  </head>
  <body class="az-body">
  <?php if(isset($attempt_in)){?>
        <div class="alert-danger">
            <?php
                if($attempt_in < 3){
                    $msg =  'Invalid user name or password.';
                }else if($attempt_in =='11'){
                    $msg = 'Invalid Code entered.';
                }else if($attempt_in =='120'){
                    $msg = 'Suspended account.';
                }else if($attempt_in =='140'){
                    $msg = 'Locked. Wait for 5min and try again.';
                }else if($attempt_in =='110'){
                    $msg = 'User account locked.';
                }
            ?>   
        </div>
    <?php }  $token= generateFormToken(); ?>
    <div class="az-signin-wrapper">
      <div class="az-card-signin">
      <?php echo (($msg))?'<div class="errormsg">'.$msg.'</div>':''; ?>
        <h1 class="az-logo"><?php echo APP_NAME; ?></h1>
        <div class="az-signin-header">
          <h2>Welcome back!</h2>
          <h4>Please sign in to continue</h4>

          <form action="index.php?action=index&pg=1" method="post" enctype="application/x-www-form-urlencoded" name="loginForm" id="loginForm" autocomplete="off">
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" placeholder="Enter your email" name="uname">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Enter your password" name="pwd">
            </div><!-- form-group -->
            <button class="btn btn-az-primary btn-block">Sign In</button>
            <input type="hidden" name="doLogin" id="doLogin" value="systemPingPass" /><br/>
            <small>us: admin@mail.com | ps: space123</small>
          </form>
          <?php $session->set('1_token', $token);  ?>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
          <p><a href="">Forgot password?</a></p>
          <p>Don't have an account? <a href="page-signup.html">Create an Account</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="media/lib/jquery/jquery.min.js"></script>
    <script src="media/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="media/lib/ionicons/ionicons.js"></script>
    <script src="media/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="media/js/jquery.cookie.js" type="text/javascript"></script>

    <script src="media/js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
