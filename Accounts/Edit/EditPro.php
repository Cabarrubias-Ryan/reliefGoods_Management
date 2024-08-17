<?php
    include('../../Connection/connection.php');
    include('../../Database/Update_Queries.php');
    include('../../Database/Display_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $Resident_id = $_POST['Resident_id'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Account_Holder = $_POST['Account_Holder'];

    $Checking = gettingPassword($connection, $Username);
    $CheckingId = gettingResidentId($connection, $Username);

    if($Checking != null && $CheckingId != $Resident_id){
        echo "<script>
            alert('Username already been use.');
            window.location.href = 'Edit.php?resident_id=$Resident_id';
        </script>";
        exit();
    }

    $result = updateAccounts($connection, $Account_Holder, $Username, password_hash($Password,PASSWORD_BCRYPT), $Resident_id);

    if($result == true){
        echo "<script>
            alert('Data successfully Updated.');
            window.location.href = '../Accounts.php';
        </script>";
        exit();
    }
    else{
        echo "<script>
            alert('Invalid Input.');
            window.location.href = 'Edit.php';
        </script>";
    exit();
    }
?>