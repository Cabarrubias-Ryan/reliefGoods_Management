<?php
    include('../../Connection/connection.php');
    include('../../Database/Update_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $resident_id = $_GET['resident_id'];
    $result = removeRepresentative($connection, $resident_id);

    if($result !== false){
        header("Location: ../Representative.php");
    }
?>