<?php
    $con = mysqli_connect('localhost', 'root', '');
    if(mysqli_connect_errno()){
        die("Connection Failed: ". mysqli_connect_errno());
    }
?>