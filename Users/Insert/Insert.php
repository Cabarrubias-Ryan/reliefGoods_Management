<?php
session_start();
require_once('../../Authentication/Authentication.php');
Authentication('../../Login.php');
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
                    <form action="Insertpro.php"  method="post" id="myForm">

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
                                <input type="text" name="firstName" id="First" required>
                            </div>
                            <div>
                                <label for="Middle">Middle Name:</label>
                                <input type="text" name="middleName" id="Middle">
                            </div>
                            <div>
                                <label for="Last">Last Name:</label>
                                <input type="text" name="lastName" id="Last" required>
                            </div>
                            <div>
                                <label for="Address">Address:</label>
                                <input type="text" name="address" id="Address" required>
                            </div>
                            <div>
                                <label for="Number">Phone Number:</label>
                                <input type="text" name="phoneNumber" minlength="11" maxlength="11" id="Number" required>
                            </div>
                            <div>
                                <label for="Birthday">Birthday:</label>
                                <input type="date" name="birthday" id="Birthday" required>
                            </div>
                            <div>
                                <label for="sex">Sex:</label>
                                <select name="sex" required>
                                    <option hidden></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label for="purok">Purok:</label>
                                <input type="text" name="purok"  required>
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