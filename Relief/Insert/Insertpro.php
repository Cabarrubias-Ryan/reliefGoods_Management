<?php
include('../../Connection/connection.php');
include('../../Database/Insert_Queries.php');
require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

// Debugging statement to confirm inclusion
echo "Files included<br>";

// Retrieve and sanitize input data
$Quantity = filter_input(INPUT_POST, 'Quantity', FILTER_VALIDATE_INT);
$Goods = filter_input(INPUT_POST, 'Goods', FILTER_SANITIZE_STRING);

if ($Quantity !== false && $Goods !== false) {
    // Debugging statement to confirm inputs
    $pack = insertReliefPack($connection, $Quantity, $Goods);

    if ($pack !== false) {
        echo "<script>
            alert('Data successfully added.');
            window.location.href = '../Reliefs.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to add data.');
            window.location.href = 'Insert.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid input data.');
        window.location.href = 'Insert.php';
    </script>";
}
?>
