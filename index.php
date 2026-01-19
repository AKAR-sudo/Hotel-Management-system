<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>HMS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Add Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Add custom animation styles -->
    <style>
        body {
            background: linear-gradient(135deg, #5da5f5 0%, #1e4b94 100%);
            overflow-x: hidden;
        }
        .main-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .account-box {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            transition: all 0.3s ease;
        }
        .account-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #1e4b94;
            box-shadow: 0 0 15px rgba(94, 165, 245, 0.2);
        }
        .btn-primary {
            border-radius: 50px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #5da5f5 0%, #1e4b94 100%);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(30, 75, 148, 0.3);
        }
        .floating-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .floating-bg div {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 8s infinite ease-in-out;
        }
        .floating-bg div:nth-child(1) {
            width: 150px;
            height: 150px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .floating-bg div:nth-child(2) {
            width: 100px;
            height: 100px;
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }
        .floating-bg div:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 15%;
            left: 15%;
            animation-delay: 4s;
        }
        .floating-bg div:nth-child(4) {
            width: 120px;
            height: 120px;
            bottom: 10%;
            right: 10%;
            animation-delay: 6s;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }
        .account-logo img {
            max-width: 200px;
            transition: all 0.5s ease;
        }
        .account-logo img:hover {
            transform: scale(1.1);
        }
    </style>
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<?php
session_start();
include('includes/connection.php');
if(isset($_REQUEST['login']))
{
    $username = mysqli_real_escape_string($connection,$_REQUEST['username']);
    $pwd = mysqli_real_escape_string($connection,$_REQUEST['pwd']);
    
    $fetch_query = mysqli_query($connection, "select * from tbl_employee where username ='$username' and password = '$pwd'");
    $res = mysqli_num_rows($fetch_query);
    if($res>0)
    {
        $data = mysqli_fetch_array($fetch_query);
        $name = $data['first_name'].' '.$data['last_name'];
        $role = $data['role'];
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        header('location:dashboard.php');
    }
    else
    {
        $msg = "Incorrect login details.";
    }
}
?>
<body>
    <div class="main-wrapper account-wrapper">
        <!-- Animated background elements -->
        <div class="floating-bg">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        
        <div class="account-page">
            <div class="account-center">
                <div class="account-box animate__animated animate__fadeInUp">
                    <form method="post" class="form-signin">
                        <div class="account-logo animate__animated animate__pulse animate__infinite animate__slower">
                            <img src="assets/img/logo-dark.png" alt="">
                            
                        </div>
                        <h2 style="text-align:center">Sulaymany Hospital</h2><br>
                        <div class="form-group animate__animated animate__fadeInLeft animate__delay-1s">
                            <label>Username</label>
                            <input type="text" autofocus="" class="form-control" name="username" required>
                        </div>
                        <div class="form-group animate__animated animate__fadeInRight animate__delay-1s">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pwd" required>
                        </div>
                        <span style="color:red;" class="animate__animated animate__fadeIn animate__delay-2s">
                            <?php if(!empty($msg)){ echo $msg; } ?>
                        </span>
                        <br>
                        <div class="form-group text-center animate__animated animate__bounceIn animate__delay-2s">
                            <button type="submit" name="login" class="btn btn-primary account-btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- Add custom animation script -->
    <script>
        $(document).ready(function() {
            // Add hover effect to input fields
            $('.form-control').focus(function() {
                $(this).parent().addClass('animate__animated animate__pulse');
            }).blur(function() {
                $(this).parent().removeClass('animate__animated animate__pulse');
            });
            
            // Button click effect
            $('.btn-primary').click(function() {
                $(this).addClass('animate__animated animate__rubberBand');
                setTimeout(function() {
                    $('.btn-primary').removeClass('animate__animated animate__rubberBand');
                }, 1000);
            });
        });
    </script>
</body>
</html>
