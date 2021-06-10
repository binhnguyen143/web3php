<?php
    include "../model/database.php";
    $data = json_decode($_POST['data']);
    mysqli_query($con, "UPDATE `tblbill` SET `fromadd` = '$data->frAddress', `toadd`='$data->toAddress', `receiver`='$data->receiver',  `items`='$data->items', `cost`='$data->cost', `idCityFr`='$data->idCityFr', `idCityTo`='$data->idCityTo'
    WHERE billcode = '$data->billcode'");
    echo json_encode(array("msg"=>"Sửa thành công"));
    mysqli_close($con);
?>