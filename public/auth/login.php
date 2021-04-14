<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title><?php echo  APP_NAME;?> : Login</title>
    <link rel="shortcut icon" href="<?php echo APP_FAVICON;?>" type="image/png">

    <!-- vendor css -->
    <link href="theme/assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="theme/assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="theme/assets/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="theme/assets/css/azia.css">
    <link rel="stylesheet" href="theme/assets/css/style.css">

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
      <div class="az-card-signin"><?php print (($msg))?'<div class="errormsg">'.$msg.'</div>':''; ?>
        <h1 class="az-logo"><?php echo  APP_NAME;?></h1>
        <div class="az-signin-header">
          <h2>Welcome back!</h2>
          <h4>Please sign in to continue</h4>
          
          <form action="index.php?action=index&pg=1" method="post" enctype="application/x-www-form-urlencoded" name="loginForm" id="loginForm" autocomplete="off">
            <input id="token" name="token" value="<?php echo $token ; ?>" type="hidden" />
            <div class="form-group">
              <label>User Name</label>
              <input type="text" class="form-control" name="uname" placeholder="Enter your user name" >
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="pwd" placeholder="Enter your password">
            </div><!-- form-group -->
            <button type="submit" class="btn btn-az-primary btn-block">Sign In</button>
            <input type="hidden" name="doLogin" id="doLogin" value="systemPingPass" /><br />
            <?php $session->set('1_token', $token);?>
          </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
          <p><a href="">Forgot password?</a></p>
          <p>Don't have an account? <a href="index.php?action=register">Create an Account</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="theme/assets/lib/jquery/jquery.min.js"></script>
    <script src="theme/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="theme/assets/lib/ionicons/ionicons.js"></script>
    <script src="theme/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="theme/assets/js/jquery.cookie.js" type="text/javascript"></script>

    <script src="theme/assets/js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
