<?php
    include "../model/database.php";
    $id = $_GET["id"];
    $res = mysqli_query($con, "SELECT * FROM tblbill WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);