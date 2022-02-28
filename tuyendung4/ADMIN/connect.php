<?php
    $hostname = 'localhost';
    $username = 'root';
    $pass ='';
    $database = 'tuyendung_hiep';
    $conn = mysqli_connect($hostname,$username,$pass,$database);
    mysqli_query($conn, 'set names"utf8"');

 ?>
