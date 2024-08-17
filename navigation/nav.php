<?php
  require_once('../Authentication/Authentication.php');
  Authentication('../Login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
      <header class="page-header">
        <nav>
          <a href="#" aria-label="forecastr logo" class="logo">
            <i style="width: 140px; height: 49px;" class="bx bx-home-heart"></i>
          </a>
          <button class="toggle-mob-menu" aria-expanded="false" aria-label="open menu">
            <i class='bx bx-menu'></i>
          </button>
          <ul class="admin-menu">
            <li class="menu-heading">
              <h3>Admin</h3>
            </li>
            <li>
              <a href="../home/home.php">
              <i class='bx bx-home'></i>
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="../Users/Users.php">
                <i class='bx bxs-user'></i>
                <span>Residents</span>
              </a>
            </li>
            <li>
              <a href="../Representative/Representative.php">
                <i class='bx bxs-user-detail'></i>
                <span>Representative</span>
              </a>
            </li>
            <li>
              <a href="../Relief/Reliefs.php">
                <i class='bx bxs-donate-heart'></i>
                <span>Relief Goods</span>
              </a>
            </li>

            <li class="menu-heading">
              <h3>Settings</h3>
            </li>
            <li>
              <a href="../History/History.php">
                <i class='bx bx-file'></i>
                <span>History</span>
              </a>
            </li>
            <li>
              <a href="../Accounts/Accounts.php">
                <i class='bx bxs-user'></i>
                <span>Accounts</span>
              </a>
            </li>
            <li>
              <a href="../Logout/Logout.php">
              <i class='bx bxs-log-out'></i>
                <span>Logout</span>
              </a>
            </li>
            <li>
              <div class="switch">
                <input type="checkbox" id="mode" checked>
                <label for="mode">
                  <span></span>
                  <span>Dark</span>
                </label>
              </div>
              <button class="collapse-btn" aria-expanded="true" aria-label="collapse menu">
              <i class='bx bx-arrow-back'></i>
                <span>Collapse</span>
              </button>
            </li>
          </ul>
        </nav>
      </header>
      <script src="../js/main.js"></script>
</body>
</html>