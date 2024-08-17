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
    <title>Relief Goods | Relief Goods Distribution System</title>
    <link rel="stylesheet" href="../css/home.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .search-input, .filter-menu {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <section id="content"  class="page-content">
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Relief Goods</a>
                        </li>
                    </ul>
                </div>
                <a href="Insert/Insert.php" class="btn-download">
                    <i class='bx bx-plus' ></i>
                    <span class="text">Add Relief Goods</span>
                </a>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List Of Relief Goods</h3>
                        <i class='bx bx-search' id="search-icon"></i>
                        <input type="text" class="search-input" id="search-input" placeholder="Search...">
                        <i class='bx bx-filter' id="filter-icon"></i>
                        <div class="filter-menu" id="filter-menu">
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th style="text-align: center; vertical-align: middle;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $RelifGoods = getAllReliefPacks($connection);
                                    
                                if(!empty($RelifGoods)){
                                    foreach($RelifGoods as $Data){
                                        ?>
                                            <tr>
                                                <td>
                                                    <p style="font-size: 12px;"><?= $Data['description']?></p>
                                                </td>
                                                <td><?= $Data['quantity'] ?></td>
                                                <td><span class="<?= ($Data['quantity'] == 0) ? 'status pending' : 'status completed' ?>"><?= ($Data['quantity'] != 0) ? 'Available' : 'Empty' ?></span></td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="todo">
                    <div class="head">
                        <h3>Representatives</h3>
                    </div>
                    <ul class="todo-list">
                        <?php
                            $resident = getPurokRepresentatives($connection);

                            if(!empty($resident)){
                                foreach($resident as $Data){
                                    if($Data['status'] == 'Active'){
                                        ?>
                                            <li class="completed"> <!-- completed/ not-completed-->
                                                <p><?= $Data['Name']?></p>
                                                <a href="Add/AddRelief.php?resident_id=<?= $Data['resident_id']?>"><i class='bx bx-plus' ></i></a>
                                            </li>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </main>
    </section>
    <script src="../js/relief.js"></script>
</body>
</html>
