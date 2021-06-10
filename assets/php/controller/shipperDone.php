<?php
    include "../model/database.php";
    $data = $_POST['selected'];
    $idShipper = $_POST['idShipper'];
    $finishdate = $_POST['finishdate'];
    foreach($data as &$id){
        mysqli_query($con, "UPDATE `tblbill` SET `status`='3', `finishdate` = '$finishdate' WHERE id = '$id'");
    }
?>