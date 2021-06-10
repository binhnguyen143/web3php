<?php
    include "../model/database.php";
    $data = $_POST['selected'];
    $idShipper = $_POST['idShipper'];
    $claimdate = $_POST['claimdate'];
    foreach($data as &$id){
        mysqli_query($con, "UPDATE `tblbill` SET `status`='2', `idShipper`='$idShipper', `claimdate` = '$claimdate' WHERE id = '$id'");
    }
?>