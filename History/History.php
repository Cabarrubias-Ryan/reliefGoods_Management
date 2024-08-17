<?php
    include('../Connection/connection.php'); // Connection
    include('../navigation/nav.php');
    include('../Database/Display_Queries.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Of Relief Destribution</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/Users.css">
    
    <style>
        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown button styles */
        .dropdown .btn {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            color: #333;
            padding: 8px 12px;
            cursor: pointer;
        }

        /* Dropdown menu styles */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            list-style-type: none;
            padding: 0;
            margin: 0;
            border: 1px solid #ccc;
            left: 50%; /* Position the left edge at the center of the container */
            transform: translateX(-50%); /* Adjust to center align the menu */
            text-align: left; /* Reset text alignment for menu items */
        }

        /* Dropdown menu items */
        .dropdown-menu li {
            text-align: center;
        }

        .dropdown-menu a {
            display: block;
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }

        /* Show dropdown menu when button is clicked */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Adjust dropdown positioning */
        .dropdown-menu {
            right: 0;
        }
        @media screen and (max-width: 767px) {
            .dropdown {
                display: flex;
                justify-content: center; /* Centers the dropdown button horizontally */
            }

            .dropdown .btn {
                width: auto; /* Ensure the button takes its natural width */
            }
            .dropdown-menu {
                left: 0; /* Reset left positioning for full width */
                transform: none; /* Reset transform */
                width: auto; /* Auto width */
                max-width: none; /* Reset max-width */
            }
        }
    </style>
</head>
<body>
<section id="content" class="page-content">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Settings</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Settings</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">History of Relief Pack Distribution</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table">
            <div class="table-header">
                <div class="header__item"><a id="name" class="filter__link" href="#">Purok Representative</a></div>
                <div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Description</a></div>
                <div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Quantity</a></div>
                <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Date Distributed</a></div>
            </div>
            <div class="table-content">
                <?php
                    $resident = reliefDistributionHistory($connection);

                    if (!empty($resident)) {
                        foreach ($resident as $Data) {
                            if($Data['quantity'] != null){
                                ?>
                                    <div class="table-row">
                                        <div class="table-data"><?= htmlspecialchars($Data['Name']) ?></div>         
                                        <div class="table-data"><?= htmlspecialchars($Data['description']) ?></div>
                                        <div class="table-data"><?= htmlspecialchars($Data['quantity']) ?></div>
                                        <div class="table-data"><?= htmlspecialchars($Data['distribution_date'])?></div>
                                    </div>
                                <?php
                            }
                        }
                    }
                ?>
            </div>    
        </div>
    </main>
</section>
</body>
</html>
