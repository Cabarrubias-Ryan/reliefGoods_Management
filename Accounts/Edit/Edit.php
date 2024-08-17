<?php
    include('../../Connection/connection.php');
    include('../../Database/Display_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

    $resident_id = $_GET['resident_id'];

    $Data = accountDetails($connection, $resident_id);
    $residentData = displayAccountHolder($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new resident</title>
    <link rel="stylesheet" href="../../css/UserForm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
        #error {
            color: red;
            display: none;
            font-size: 10px;
        }
    </style>
    <script>
        function validateForm(event) {
            var password = document.forms["myForm"]["Password"].value;
            var retypePassword = document.forms["myForm"]["Retype_Password"].value;
            var errorDiv = document.getElementById("error");

            if (password.length < 5) {
                errorDiv.style.display = "block";
                errorDiv.innerText = "Password must be at least 5 characters long.";
                event.preventDefault();
                return false;
            }

            if (password !== retypePassword) {
                errorDiv.style.display = "block";
                errorDiv.innerText = "Passwords do not match.";
                event.preventDefault();
                return false;
            }

            errorDiv.style.display = "none";
            return true;
        }
    </script>
</head>
<body>
    <div id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Fill the Form</h4>
                    <a href="../Accounts.php" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form action="EditPro.php" method="post" id="myForm" name="myForm" onsubmit="validateForm(event)">
                        <div class="card imgholder">
                            <label for="imgInput" class="upload">
                                <input type="file" name="imgInput" id="imgInput" accept="image/*">
                                <i class='bx bx-plus-circle'></i>
                            </label>
                            <img src="../../image/person.png" alt="Profile" class="img">
                        </div>

                        <div class="inputField">
                            <input type="hidden" name="Resident_id" value="<?= $resident_id?>">
                            <div>
                                <label for="Username">Username:</label>
                                <input type="text" name="Username" value="<?= htmlspecialchars($Data[0]['username'] ?? '') ?>" required>
                            </div>
                            <div>
                                <label for="Password">Password:</label>
                                <input type="password" name="Password" required>
                            </div>
                            <div>
                                <label for="Retype_Password">Retype Password:</label>
                                <input type="password" name="Retype_Password" required>
                            </div>
                            <div>
                                <label for="Account_Holder">Account Holder:</label>
                                <select name="Account_Holder">
                                    <option value="<?= $resident_id?>" hidden><?= htmlspecialchars($Data[0]['Name'] ?? '') ?></option>
                                    <?php

                                        if(!empty($residentData)){
                                            foreach($residentData as $Data){
                                                ?>
                                                    <option value="<?= $Data['resident_id'] ?>"><?= $Data['Name'] ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div id="error"></div>
                        </div>
                </div>

                <div class="modal-footer">
                    <a href="../Accounts.php" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary submit">
                </div>
                
                </form>
            </div>
        </div>
    </div>
</body>
</html>
