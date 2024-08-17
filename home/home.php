<?php
	include('../Connection/connection.php'); // Connection
	include('../Database/Display_Queries.php');
    include('../navigation/nav.php');

	$countReliefPack = countReliefPack($connection);
	$countResident = countResident($connection);
	$countDistribution = countDistribution($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Relief Goods Distribution System</title>
    <link rel="stylesheet" href="../css/home.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">	
					<i class='bx bxs-smile'></i>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?= $countReliefPack ?></h3>
						<p>Relief Goods</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?= $countResident ?></h3>
						<p>Residents</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-badge-check'></i>
					<span class="text">
						<h3><?= $countDistribution ?></h3>
						<p>Distribute Goods</p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Relief Goods</h3>
						<a href="../Relief/Reliefs.php"><i class='bx bx-show'></i></a>
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
								$reversedResident = array_reverse($RelifGoods);
								
								// Get only the first 5 elements of the reversed array
								$limitedResident = array_slice($reversedResident, 0, 5);

								foreach($limitedResident as $Data){
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
						<h3>Resident</h3>
						<a href="../Users/Users.php"><i class='bx bx-show'></i></a>
					</div>
					<ul class="todo-list">
					<?php
						$resident = getResidentDetails($connection);

						if (!empty($resident)) {
							// Reverse the array
							$reversedResident = array_reverse($resident);
							
							// Get only the first 5 elements of the reversed array
							$limitedResident = array_slice($reversedResident, 0, 5);

							foreach ($limitedResident as $Data) {
								?>
								<li>
									<p><?= $Data['Name'] ?></p>
								</li>
								<?php
							}
						}
					?>
					</ul>
				</div>
			</div>
		</main>
    </section>
</body>
</html>