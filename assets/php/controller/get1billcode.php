<?php
    include "../model/database.php";
    $billcode = $_GET["billcode"];
    $res = mysqli_query($con, "SELECT * FROM tblbill WHERE billcode=$billcode");
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);