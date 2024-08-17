<?php
    include('../../Connection/connection.php');
    include('../../Database/Display_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $Id = isset($_GET['resident_id']) ? intval($_GET['resident_id']) : 0;
    $Data = ResidentDetails($connection, $Id);

    // Assuming $Data contains a single resident's details as the first element of the array
    $resident = !empty($Data) ? $Data[0] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Resident Details</title>
    <link rel="stylesheet" href="../../css/UserForm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap 5 icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div id="userForm">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <a href="../Accounts.php" class="btn-close"></a>
            </div>

            <div class="modal-body">

                <form action="Insertpro.php" method="get" id="myForm">

                    <div class="card imgholder">
                        <label for="imgInput" class="upload">
                            <input type="file" name="imgInput" id="imgInput" accept="image/*">
                            <i class='bx bx-plus-circle'></i>
                        </label>
                        <img src="../../image/person.png" alt="Profile" class="img">
                    </div>

                    <div class="inputField">
                        <div>
                            <label for="First">First Name:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['first_name'] ?? '') ?>" readonly>
                        </div>
                        <div>
                            <label for="Middle">Middle Name:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['middle_name'] ?? '') ?>" readonly>
                        </div>
                        <div>
                            <label for="Last">Last Name:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['last_name'] ?? '') ?>" readonly>
                        </div>
                        <div>
                            <label for="Address">Address:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['address'] ?? '') ?>" readonly>
                        </div>
                        <div>
                            <label for="Number">Phone Number:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['contact_number'] ?? '') ?>" readonly>
                        </div>
                        <div>
                            <label for="Birthday">Birthday:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['birthday'] ?? '') ?>" readonly>
                        </div>
                        <div>
                            <label for="city">Sex:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['sex'] ?? '') ?>" readonly>
                        </div>
                        <div>
                            <label for="phone">Purok:</label>
                            <input type="text" value="<?= htmlspecialchars($resident['purok'] ?? '') ?>" readonly>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>