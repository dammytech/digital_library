<?php
    include_once '../includes/db.inc.php';
    include_once '../includes/access.inc.php';
    include_once '../includes/functions.inc.php';
    
    if (!userIsLoggedIn()) {
        setcookie('loginError', 'Username or Password Incorrect!!!', time()+5, '/');
        header('Location: ../login_form.html.php');
        exit();
    }
    
    if (isset($_GET['logout']) && $_GET['logout'] == 'yes') {
        userIsLoggedIn();
        exit();
    }
    
    include 'index.php';
    exit();