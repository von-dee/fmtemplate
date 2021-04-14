<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME;?></title>

    <link rel="shortcut icon" href="<?php echo APP_FAVICON;?>" type="image/png">
    <!-- Bootstrap core CSS -->
    <link href="theme/assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme/assets/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <link href="theme/assets/vendors/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="theme/assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="theme/assets/css/style.css" rel="stylesheet">

    <script src="theme/assets/vendors/jquery/jquery.min.js"></script>

</head>

<body class="page-auth">
    <?php if(isset($attempt_in)){?>
        <div class="alert-danger">
            <?php
                if($attempt_in = '0'){
                    $msg =  'Please fill all fields to continue...';
                }else if($attempt_in =='1'){
                    $msg = 'Invalid Code generation for user.';
                }else if($attempt_in =='120'){
                    $msg = 'User id generation Error.';
                }
            ?>   
        </div>
    <?php }  $token = generateFormToken(); ?>
    <div class="wrapper">
        <div class="login-form centered">
            <div class="row login-content">
                <div class="col-sm-12">
                    <div class="brand"><img src="<?php echo APP_LOGO;?>" alt="logo" width="180px"></div>
                </div>
                <div class="col-sm-7 cover-image"></div>
                
                <div class="col-lg-5 col-sm-12 login-block">
                    <h4>Register  User</h4>
                    <?php echo (($msg))?'<div class="errormsg">'.$msg.'</div>':''; ?>
                    <form action="index.php?action=register&pg=1" method="post" enctype="application/x-www-form-urlencoded"
                        name="loginForm" id="loginForm" autocomplete="off">
                        <input id="token" name="token" value="<?php echo $token ; ?>" type="hidden" />
                        <div class="login-tab mb-3" shadow>
                            <div class="input-group login-input mb-1">
                                <div class="input-group-prepend">
                                    <i class="la la-signature input-group-text"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="first name" aria-label="text" aria-describedby="basic-addon1" name="ufname">
                            </div>
                            <div class="input-group login-input mb-1">
                                <div class="input-group-prepend">
                                    <i class="la la-signature input-group-text"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="last name" aria-label="text" aria-describedby="basic-addon1" name="ulname">
                            </div>
                            <div class="input-group login-input mb-1">
                                <div class="input-group-prepend">
                                    <i class="la la-at input-group-text"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="email" aria-label="Email" aria-describedby="basic-addon1" name="uemail">
                            </div>
                            <div class="input-group login-input mb-1">
                                <div class="input-group-prepend">
                                    <i class="la la-phone input-group-text"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="phone number" aria-label="PhoneNumber" aria-describedby="basic-addon1" name="uphoneno">
                            </div>
                            <div class="input-group login-input mb-1">
                                <div class="input-group-prepend">
                                    <i class="la la-user input-group-text"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="user name" aria-label="UserName" aria-describedby="basic-addon1" name="uname">
                            </div>
                            
                            <div class="input-group login-input" border-top>
                                <div class="input-group-prepend">
                                    <i class="la la-lock input-group-text"></i>
                                </div>
                                <input type="password" class="form-control" placeholder="******" aria-label="Email" aria-describedby="basic-addon1" name="pwd">
                            </div>
                        </div>

                        <div class="btn-block">
                            <button type="submit" class="btn btn-primary login-btn">Register</button>
                            <a href="index.php?action=login" class="btn btn-danger login-btn pt-2">Cancel</a><br>
                            <?php $session->set('1_token', $token);?>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="theme/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="theme/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="public/root.script.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>