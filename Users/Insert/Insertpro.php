<?php

    include('../../Connection/connection.php');
    include('../../Database/Insert_Queries.php');
    include('../../Database/Display_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $actionSuccessful = false;

    $First_name = $_POST['firstName'];
    $Middle_name = $_POST['middleName'];
    $Last_name = $_POST['lastName'];
    $Address = $_POST['address'];
    $PhoneNumber = $_POST['phoneNumber'];
    $Birthday = $_POST['birthday'];
    $Sex = $_POST['sex'];
    $Purok = $_POST['purok'];

    $purokResult = getPurokIdByName($connection, $Purok); // result a null or data (purok_id)

    if($purokResult == null){
        $PurokId = insertPurok($connection, $Purok);

        if ($PurokId !== false) {
            $Resident_id = insertResident($connection, $PurokId, $Last_name, $First_name, $Middle_name, $Birthday, $Sex);
            
            // Insert into contact_number
            if ($Resident_id !== false) {
                insertContactNumber($connection, $Resident_id, $PhoneNumber);
                
                // Insert into household
                insertHousehold($connection, $PurokId, $Last_name, $Address, $Resident_id);
    
                $actionSuccessful = true;
            }
        }
    }
    else{

        $Resident_id = insertResident($connection, $purokResult, $Last_name, $First_name, $Middle_name, $Birthday, $Sex);  
        // Insert into contact_number
        if ($Resident_id !== false) {
            insertContactNumber($connection, $Resident_id, $PhoneNumber);
            
            // Insert into household
            insertHousehold($connection, $purokResult, $Last_name, $Address, $Resident_id);

            $actionSuccessful = true;
        }
    }

    if ($actionSuccessful) {
        echo "<script>
            alert('Data successfully inserted.');
            window.location.href = '../Users.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to add data.');
            window.location.href = 'Insert.php';
        </script>";
    }


?>