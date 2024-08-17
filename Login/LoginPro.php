<?php
    include('../Connection/connection.php');
    include('../Database/Display_Queries.php');

    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $storedPassword = gettingPassword($connection, $Username);
    $_SESSION['loginChecker'] = false;
    
    if($storedPassword !== null){
        if(password_verify($Password, $storedPassword)){
            $_SESSION['loginChecker'] = true;
            header('Location: ../home/home.php');
            exit();
        }
        else{
            header('Location: ../Login.php?Input=wrong&username='.urlencode($Username));
            exit(); 
        }
    }
    else{
        header('Location: ../Login.php?Input=wrong&username='.urlencode($Username));
        exit();
    }
?>