<?php

function Authentication($redirectPath = '../Login.php') {
    if(!isset($_SESSION['loginChecker']) || $_SESSION['loginChecker'] == false) {
        header("Location: " . $redirectPath);
        exit(); // Stop script execution after the redirect
    }
}
    
?>