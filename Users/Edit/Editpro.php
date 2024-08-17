<?php
    include('../../Connection/connection.php');
    include('../../Database/Update_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');
    $actionSuccessful = true;
    $First_name = htmlspecialchars($_POST['First'], ENT_QUOTES, 'UTF-8');
    $Middle_name = htmlspecialchars($_POST['Middle'], ENT_QUOTES, 'UTF-8');
    $Last_name = htmlspecialchars($_POST['Last'], ENT_QUOTES, 'UTF-8');
    $Address = htmlspecialchars($_POST['Address'], ENT_QUOTES, 'UTF-8');
    $PhoneNumber = htmlspecialchars($_POST['Number'], ENT_QUOTES, 'UTF-8');
    $Birthday = htmlspecialchars($_POST['Birthday'], ENT_QUOTES, 'UTF-8');
    $Sex = htmlspecialchars($_POST['Sex'], ENT_QUOTES, 'UTF-8');
    $Purok = htmlspecialchars($_POST['Purok'], ENT_QUOTES, 'UTF-8');
    $Resident_id = htmlspecialchars($_POST['Resident_id'], ENT_QUOTES, 'UTF-8');
    $Con_id = htmlspecialchars($_POST['Con_id'], ENT_QUOTES, 'UTF-8');
    $Household_id = htmlspecialchars($_POST['Household_id'], ENT_QUOTES, 'UTF-8');
    $Purok_id = htmlspecialchars($_POST['Purok_id'], ENT_QUOTES, 'UTF-8');

    
    updateResident($connection, $Resident_id, $Last_name, $First_name, $Middle_name, $Birthday, $Sex);
    updatePurok($connection, $Purok_id, $Purok);
    updateContactNumber($connection, $Con_id, $PhoneNumber);
    updateHousehold($connection, $Household_id, $Last_name, $Address);

    if ($actionSuccessful) {
        echo "<script>
            alert('Data successfully Updated.');
            window.location.href = '../Users.php';
        </script>";
    } else {
        // error back to Edit.php
    }
?>