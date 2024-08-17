<?php
    include('../../Connection/connection.php');
    include('../../Database/Insert_Queries.php');
    include('../../Database/Update_Queries.php');
    include('../../Database/Display_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $resident_id = $_POST['Resident_id'];
    $goods = $_POST['Goods'];
    $quantity = $_POST['Quantity'];

    $reliefQuantity = getReliefPackQuantity($connection, $goods);
    $currentQuantity = $reliefQuantity - $quantity;


    if($currentQuantity < 0){
        echo "<script>
            alert('Entered quantity exceeds available relief goods.');
            window.location.href = 'AddRelief.php?resident_id=$resident_id';
        </script>";
        exit();
    }

    $household_id = getHouseholdIdByResidentId($connection, $resident_id);

    $distribution_date = date('Y-m-d');
    
    $ReliefDistibution = insertReliefDistribution($connection, $distribution_date, $quantity, $goods, $household_id, $resident_id );

    if($ReliefDistibution !== false){
        updateReliefPackQuantity($connection, $currentQuantity, $goods);
    }
    echo "<script>
            alert('You successfully inputed the data.');
            window.location.href = '../Reliefs.php';
        </script>";
    exit();
?>
