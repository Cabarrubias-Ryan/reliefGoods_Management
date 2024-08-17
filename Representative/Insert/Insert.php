<?php
    include('../../Connection/connection.php');
    include('../../Database/Display_Queries.php');
    require_once('../../Authentication/Authentication.php');
    Authentication('../../Login.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new representative</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        .modal-header {
            background-color: #0d6efd;
            color: #fff;
        }

        .modal-body form {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .inputField {
            flex: 1 1 100%;
            padding: 20px;
        }

        .inputField div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .inputField label {
            font-size: 14px;
            font-weight: 500;
        }

        .inputField label::after {
            content: "*";
            color: red;
        }

        .inputField select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>');
            background-repeat: no-repeat;
            background-size: 12px 12px;
            padding-right: 1.5rem;
        }

        .modal-footer .submit {
            font-size: 15px;
        }
        form .inputField > div select {
            font-size: 13px;
            width: 90%;
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

        .dropdown-menu {
            width: auto;
            min-width: auto;
            padding: 0.5rem; /* Optional: Add padding to make the dropdown items more readable */
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
                <a href="../Representative.php" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <form action="Insertpro.php" method="post" id="myForm">
                    <div class="inputField">
                        <div>
                            <label for="Name">Name:</label>
                            <select name="Resident_id" required>
                                <option hidden></option>
                                <?php
                                    $ResidentData = getResidentNames($connection);

                                    if(!empty($ResidentData)){
                                        foreach($ResidentData as $Data){

                                            ?>
                                                <option value="<?= $Data['resident_id']?>"><?= $Data['Name']?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="status">Purok:</label>
                            <select name="Purok" required>
                                <option hidden></option>
                                <?php
                                    $PurokData = getPurokData($connection);

                                    if(!empty($PurokData)){
                                        foreach($PurokData as $Data){
                                            ?>
                                                <option value="<?= $Data['purok']?>"><?= $Data['purok'] ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                
            </div>

            <div class="modal-footer">
                <a href="../Representative.php" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                <input type="submit" class="btn btn-primary submit">
            </div>
        </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl6prHqXxyb8rq2i0p9joQn6ljbx1zrf4pMiG60oCG8Waid8vgp8Cl0ETjp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGKt7u7w4lT+Is8BgaA5r9/Xb7DRR5K1uDVyKYY1l/hsHdUuGv5JA8s8e44" crossorigin="anonymous"></script>
</body>
</html>
