<?php
    include('../Connection/connection.php'); // Connection
    include('../Database/Display_Queries.php');
    include('../navigation/nav.php'); // navigation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts | Relief Goods Distribution System</title>
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
                        <a class="active" href="#">List of Accounts</a>
                    </li>
                </ul>
            </div>
            <a href="Insert/Insert.php" class="btn-download"><i class='bx bxs-user-plus'></i> Register Account</a>
        </div>

        <div class="table">
            <div class="table-header">
                <div class="header__item"><a id="name" class="filter__link" href="#">Name</a></div>
                <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Purok</a></div>
                <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Username</a></div>
                <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Option</a></div>
            </div>
            <div class="table-content">
                <?php
                    $resident = displayAccount($connection);

                    if (!empty($resident)) {
                        foreach ($resident as $Data) {
                                ?>
                                <div class="table-row">        
                                    <div class="table-data"><?= htmlspecialchars($Data['Name']) ?></div>
                                    <div class="table-data"><?= htmlspecialchars($Data['purok']) ?></div>
                                    <div class="table-data"><?= htmlspecialchars($Data['username']) ?></div>
                                    <div class="dropdown table-data">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item" href="View/View.php?resident_id=<?= $Data['resident_id'] ?>">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="Edit/Edit.php?resident_id=<?= $Data['resident_id'] ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                    }
                ?>
            </div>    
        </div>
    </main>
</section>

</body>
</html>
