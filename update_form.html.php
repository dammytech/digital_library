<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <meta name="author" content="MUBARAK MOSHOOD">
       	<meta name=viewport content='width=700'>
        <link rel="stylesheet" 
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../stylesheet/fonts/">
        <link rel="stylesheet" type="text/css" href="../stylesheet/bootstrap/css/bootstrap.min.css">
        <script src="../stylesheet/bootstrap/js/jquery-1.11.2.min.js"></script>
        <script src="../stylesheet/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--=======================Start Navigation=======================-->
        <div class="container-fluid">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" 
                                data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            <img src="../images/Noun_logo_mini.jpg" width="" height="" 
                                 alt="NOUN VIRTUAL LIBRARY">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                        </ul>
                    </div>
                </div>
            </nav>
            <!--=====================End Navigation=======================-->
            
            <!--=======================Start Content======================-->
            <div class="row">
                <div  class="col-md-3">
                    
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <h1 style="background-color: forestgreen; color: #F9FFFD;">UPDATE</h1>
                    </div><br/><br/>
                    <div class="well well-lg">
                        <p><a href="login_processor.php"><span class="glyphicon glyphicon-arrow-left"></span> Back 
                                to My Dashboard</a></p>
                        <form id="update-form" name="update_form"
                              action="login_processor.php" method="POST">
                            <h3 style="color: forestgreen;">Update your Account</h3>
                            <div class="form-group">
                                <label for="update-form-firstname">First Name:</label>
                                <input id="firstname" name="first_name" class="form-control input-lg" 
                                       type="text" value="<?php htmlout($user['first_name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="update-form-lastname">Last Name:</label>
                                <input id="lastname" name="last_name" class="form-control input-lg" 
                                       type="text" value="<?php htmlout($user['last_name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="update-form-username">Email:</label>
                                <input id="email" name="email" class="form-control input-lg" readonly
                                       type="email" value="<?php htmlout($user['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="register-form-password">New Password:</label>
                                <input id="password" name="password" class="form-control input-lg" 
                                       type="password" placeholder="Enter new password" 
                                       value="" required>
                            </div>
                            <div class="form-group">
                                <label for="register-form-password">Confirm Password:</label>
                                <input id="confirm_password" name="password" class="form-control input-lg" 
                                       type="password" placeholder="Confirm new password" required>
                            </div>
                            <div class="form-group">
                                <br/>
                                <button class="btn btn-lg btn-block" 
                                        id="update-form-submit" name="update_form" 
                                        style="background-color: forestgreen; color: #F9FFFD;"
                                        value="update">Update Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div  class="col-md-3">
                    
                </div>
            </div>
            <!--=================End Content==================-->
            
            <!--=================Start Footer==================-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="well well-lg text-center" style="background-color:black;">
                        <span class="text-warning">COPYRIGHT &copy; 2017</span> 
                        <span style="color: forestgreen;">NOUN</span>
                    </div>
                </div>
            </div>
            <!--=================End Footer==================-->
        </div><!--end container-->
        <script>
            /*****JS: confirms password *****/
            var password = document.getElementById("password"), 
                    confirm_password = document.getElementById("confirm_password");
            function validatePassword(){
              if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
              } else {
                confirm_password.setCustomValidity('');
              }
            }
            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>
    </body>
</html>