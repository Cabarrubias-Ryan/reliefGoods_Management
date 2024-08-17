<?php
    include('../../Connection/connection.php');
    include('../../Database/Insert_Queries.php');
    include('../../Database/Display_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Retype_Password = $_POST['Retype_Password'];
    $Account_Holder = $_POST['Account_Holder'];

    $Checking = gettingPassword($connection, $Username);

    if($Checking != null){
        echo "<script>
            alert('Username already been use.');
            window.location.href = 'Insert.php';
        </script>";
        exit();
    }

    $Status = "Active";
    $Data = insertAccount($connection, $Account_Holder, $Username, password_hash($Password,PASSWORD_BCRYPT), $Status);
    
    if($Data == true){
        echo "<script>
            alert('Data successfully Added.');
            window.location.href = '../Accounts.php';
        </script>";
    }
?>