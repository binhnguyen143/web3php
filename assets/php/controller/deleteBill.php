<?php
    include "../model/database.php";
    $data = $_POST['selected'];
    foreach($data as &$id){
        mysqli_query($con, "UPDATE `tblbill` SET `status`='0' WHERE id = '$id'");
    }
?>