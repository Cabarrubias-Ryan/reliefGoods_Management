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
    <title>Edit resident Details</title>
    <link rel="stylesheet" href="../../css/UserForm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Bootstrap 5 icons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Custom styles for select tags */
        form .inputField > div select {
            font-size: 10px;
            width: 80%;
            padding: 3px;
            border: none;
            outline: none;
            background: transparent;
            border-bottom: 1px solid black;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px 12px;
            padding-right: 1.5rem;
        }
        form .inputField > div select option {
            background: #fff;
            color: #000;
        }
        form .inputField > div select:focus {
            outline: none;
            border-bottom: 1px solid #0d6efd;
        }
    </style>
</head>
<body>
<div id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Fill the Form</h4>
                    <a href="../Users.php" class="btn-close"></a>
                </div>

                <div class="modal-body">

                    <form action="Editpro.php"  method="Post" id="myForm">

                        <div class="card imgholder">
                            <label for="imgInput" class="upload">
                                <input type="file" name="imgInput" id="imgInput" accept="image/*">
                                <i class='bx bx-plus-circle'></i>
                            </label>
                            <img src="../../image/person.png" alt="Profile" class="img">
                        </div>

                        <div class="inputField">
                            <input type="hidden" value="<?= htmlspecialchars($resident['resident_id'] ?? '') ?>" name="Resident_id">
                            <input type="hidden" value="<?= htmlspecialchars($resident['con_id'] ?? '') ?>" name="Con_id">
                            <input type="hidden" value="<?= htmlspecialchars($resident['household_id'] ?? '') ?>" name="Household_id">
                            <input type="hidden" value="<?= htmlspecialchars($resident['purok_id'] ?? '') ?>" name="Purok_id">
                            <div>
                                <label for="First">First Name:</label>
                                <input type="text" name="First" value="<?= htmlspecialchars($resident['first_name'] ?? '') ?>" required>
                            </div>
                            <div>
                                <label for="Middle">Middle Name:</label>
                                <input type="text" name="Middle" value="<?= htmlspecialchars($resident['middle_name'] ?? '') ?>">
                            </div>
                            <div>
                                <label for="Last">Last Name:</label>
                                <input type="text" name="Last" value="<?= htmlspecialchars($resident['last_name'] ?? '') ?>" required>
                            </div>
                            <div>
                                <label for="Address">Address:</label>
                                <input type="text" name="Address" value="<?= htmlspecialchars($resident['address'] ?? '') ?>" required>
                            </div>
                            <div>
                                <label for="Number">Phone Number:</label>
                                <input type="text" name="Number" value="<?= htmlspecialchars($resident['contact_number'] ?? '') ?>" required>
                            </div>
                            <div>
                                <label for="Birthday">Birthday:</label>
                                <input type="date" name="Birthday" value="<?= htmlspecialchars($resident['birthday'] ?? '') ?>" required>
                            </div>
                            <div>
                                <label for="sex">Sex:</label>
                                <select name="Sex" required>
                                    <option value="<?= htmlspecialchars($resident['sex'] ?? '') ?>" hidden><?= htmlspecialchars($resident['sex'] ?? '') ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label for="Purok">Purok:</label>
                                <input type="text" name="Purok" value="<?= htmlspecialchars($resident['purok'] ?? '') ?>" required>
                            </div>
                        </div>

                </div>

                <div class="modal-footer">
                    <a href="../Users.php" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary submit">
                </div>
                
                </form>
            </div>
        </div>
    </div>
</body>
</html>