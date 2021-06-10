<?php
    $con = mysqli_connect('localhost','root','','web3');
    if($con->connect_error){
        die("Kết nối CSDL thất bại: ".$con->connect_error);
    }
    mysqli_set_charset($con,"utf8");
?>