<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="shortcut icon" href="<?php echo APP_FAVICON; ?>" type="image/png">
    <!-- Generated: 2018-04-06 16:27:42 +0200 -->
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link rel="stylesheet" href="media/css/style.css">
    <script src="media/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="media/css/dashboard.css" rel="stylesheet" />
    <script src="media/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="media/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="media/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="media/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="media/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="media/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="page-login">
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
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="<?php echo APP_LOGO; ?>" class="h-9" alt="Logo">
              </div>
              <form class="card" action="index.php?action=index&pg=1" method="post" enctype="application/x-www-form-urlencoded" name="loginForm" id="loginForm" autocomplete="off">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <?php echo (($msg))?'<div class="errormsg">'.$msg.'</div>':''; ?>
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="uname">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pwd">
                  </div>
                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    <input type="hidden" name="doLogin" id="doLogin" value="systemPingPass" /><br/>
                    <small>us: admin@mail.com | ps: space123</small>
                  </div>
                </div>
              </form>
              <?php $session->set('1_token', $token);  ?>
              <div class="text-center text-muted">
                Don't have account yet? <a href="#">Sign up</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>