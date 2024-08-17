<?php
    session_start();
    $connection = mysqli_connect('localhost','root','root','relief',3306);

    if(!$connection)
    {
        die('Connection failed'.mysqli_connect_error());
    }
?>