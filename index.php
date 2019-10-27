<?php
    
    //Selects user details.
    if (isset($_SESSION['email'], $_SESSION['password'])) {
        try {
            $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
            $s = $pdo->prepare($sql);
            $s->bindvalue(':email', $_SESSION['email']);
            $s->bindvalue(':password', $_SESSION['password']);
            $s->execute();
        } catch (PDOException $ex) {
            echo 'error reading user details.';
            exit();
        }
    } else {
        header('Location: ../login_form.html.php');
        exit();
    }
    $user = $s->fetch(); 
    
    //Selects all schools
    try {
        $s = $pdo->query('SELECT * FROM schools');
    } catch (PDOException $ex) {
        echo 'Error selecting schools';
        exit();
    }
    $schools = $s->fetchall();
    
    //Selects all resource types
    try {
        $s = $pdo->query('SELECT * FROM resource_type');
    } catch (PDOException $ex) {
        echo 'Error selecting resource types';
        exit();
    }
    $resource_types = $s->fetchall();
    
    /*==========Start Search the database for resources=========*/
    if (isset($_GET['searchQuery']) && $_GET['searchQuery'] == 'search') {
        include '../includes/db.inc.php';
    
        $select = "SELECT *";
        $from = " FROM resources";
        $where = " WHERE TRUE";

        $placeholders = array();

        if ($_GET['school'] != '') { //A school was selected.
            $where .= " AND school_id = :school_id";
            $placeholders[':school_id'] = $_GET['school'];
        }

        if ($_GET['resource_type'] != '') { //A resource type was selected.
            $where .= " AND resource_type = :resource_type";
            $placeholders[':resource_type'] = $_GET['resource_type'];
        }

        if  ($_GET['containingText'] != '') { //A search string was specified.
            $where .= " AND name LIKE :containingText";
            $placeholders[':containingText'] = '%' . $_GET['containingText'] . '%';
        }

        try {
            $sql = $select . $from . $where;
            $r = $pdo->prepare($sql);
            $r->execute($placeholders);
        } catch (PDOException $ex) {
            echo 'error';
            exit();
        }

        $resources = null;

        foreach ($r as $row) {//If result is found.
            $resources[] = array('id' => $row['id'], 'name' => $row['name'],
                'path' => $row['path'], 'school_id' => $row['school_id'],
                'resource_type' => $row['resource_type']);
        }
        if (is_null($resources)) {//If result is not found.
            $GLOBALS['resultEmpty'] = 'yes';
        }

        /*****************************/
        //Select school, resource type, &
        //the containing text searched for.
        try{
            $sql = 'SELECT name FROM schools where id = :id';
            $s = $pdo->prepare($sql);
            $s->bindValue(':id', $_GET['school']);
            $s->execute();
        } catch (PDOException $er) {
            echo 'error';
            exit();
        }
        $schoolSelected = $s->fetch();

        try{
            $sql = 'SELECT type FROM resource_type where id = :id';
            $r = $pdo->prepare($sql);
            $r->bindValue(':id', $_GET['resource_type']);
            $r->execute();
        } catch (PDOException $er) {
            echo 'error';
            exit();
        }
        $resourceTypeSelected = $r->fetch();

        $containingTextEntered = htmlspecialchars($_GET['containingText'], ENT_QUOTES, 'UTF-8');
        /****************************/

        include 'dashboard.html.php';
        exit();
    }
    
    /*==========END Search the database for resources*=========/

    
    /*================UPDATE USER=====================*/
    //Builds value for the update form
    if (isset($_POST['update_profile_id']) && ($_POST['update_profile_email'])) {
        try {
            $sql = 'SELECT * FROM users WHERE id = :id AND email = :email';
            $s = $pdo->prepare($sql);
            $s->bindvalue(':id', $_POST['update_profile_id']);
            $s->bindvalue(':email', $_POST['update_profile_email']);
            $s->execute();
        } catch (PDOException $er) {
            echo 'error reading user details.';
            exit();
        }
        $user = $s->fetch();
        include './update_form.html.php';
        exit();
    }
    
    //Updates an existing user.
    if (isset($_POST['update_form']) && $_POST['update_form'] == 'update') {
        if (databaseContainsUserRegister($_POST['email'])) {
            $password = md5($_POST['password'] . 'nounvirtuallibrary');
            try {
                $sql = 'UPDATE users SET first_name = :fname, last_name'
                        . ' = :lname, email = :email, password = :pass WHERE email = :email';
                $s = $pdo->prepare($sql);
                $s->bindvalue(':fname', $_POST['first_name']);
                $s->bindvalue(':lname', $_POST['last_name']);
                $s->bindvalue(':email', $_POST['email']);
                $s->bindvalue(':pass', $password);
                $s->execute();
            } catch (PDOException $er) {
                echo 'error updating user.';
                exit();
            }
            
            setcookie('update', 'Update successful!!!', time()+5, '/');
            header('Location: login_processor.php');
            exit();
        } else {
            setcookie('update_f', 'Update failed!!!', time()+5, '/');
            header('Location: login_processor.php');
            exit();
        }    
    }
    /*====================END UPDATE USER==========================*/
    
    /*=====================UPLOAD IMAGE=====================*/
    if (isset($_POST['upload_image'])) {
        if (!is_uploaded_file($_FILES['upload']['tmp_name'])) {
            echo 'please select a file to upload.';
            exit();
        }
        
        $file_type = $_FILES['upload']['type'];
        if ($file_type != 'image/jpeg') {
            echo 'Please upload a jpg document. Accepted extension .jpg only.';
            exit();
        }
    
        /***Copy the image to the avatars folder.***/
        $src = $_FILES['upload']['tmp_name'];
        $name = $_FILES['upload']['name'];
        $target = $_SERVER['DOCUMENT_ROOT'] . '/NounVirtualLibrary/avatars/' . $name;
        $file_path = 'http://localhost/NounVirtualLibrary
		/avatars/' . $name;
        /*=======Delete the old image file before adding a new one======*/
        //Select the avatar_path to 
        //delete from users table.
        try {
            $sql = 'SELECT avatar_path FROM users WHERE id = :id';
            $r = $pdo->prepare($sql);
            $r->bindValue(':id', $_POST['upload_image']);
            $r->execute();
        } catch (PDOException $er) {
            echo 'error selecting avatar_path';
            exit();
        }
        $old_file_path = $r->fetch();
        $old_file_path_disk = str_replace('http://localhost', $_SERVER['DOCUMENT_ROOT'],
                $old_file_path['avatar_path']);
        unlink($old_file_path_disk);//delete the avatar.
        
        //copy the new avatar to folder
        copy($src, $target);
        
        //updates the avatar.
        try {
            $sql = 'UPDATE users SET avatar_path = :avatar WHERE id = :id';
            $s = $pdo->prepare($sql);
            $s->bindvalue(':avatar', $file_path);
            $s->bindvalue(':id', $_POST['upload_image']);
            $s->execute();
        } catch (PDOException $er) {
            echo 'error adding avatar';
            exit();
        }
        
        header('Refresh: 0');
        exit();
    }
    /*=====================END UPLOAD IMAGE=====================*/
    
    include 'dashboard.html.php';
    exit();