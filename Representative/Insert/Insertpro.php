<?php

    include('../../Connection/connection.php');
    include('../../Database/Insert_Queries.php');
    include('../../Database/Display_Queries.php');
    include('../../Database/Update_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $Resident_id = $_POST['Resident_id'];
    $Purok = $_POST['Purok'];

    $result = representativeChecking($connection, $Resident_id);

    if($result == null){
        $Purok_id = getPurokIdByName($connection,$Purok);
        if($Purok_id !== false){

            insertPurokRepresentative($connection, $Resident_id, $Purok_id, "Active");
            
            echo "<script>
                alert('Data successfully Added.');
                window.location.href = '../Representative.php';
            </script>";
        }
    }
    else{
        $Purok_id = getPurokIdByName($connection,$Purok);

        $reassigningData = reassignRepresentative($connection, $Resident_id, $Purok_id);

        if($reassigningData == true){
            echo "<script>
                alert('Data successfully Added.');
                window.location.href = '../Representative.php';
            </script>";
        }
    }

    

?>