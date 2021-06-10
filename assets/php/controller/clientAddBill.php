<?php
    include "../model/database.php";
    $data = json_decode($_POST['data']);
    $res = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tblbill WHERE idClient = $data->idClient ORDER BY id DESC"));
    $res2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbluser WHERE id = $data->idClient"));
    if($res!=1): $billCode = ((string)((int)$res['id']+1)).($res2['username']);
    else: $billCode = ("1").($res2['username']);
    endif;
    
    mysqli_query($con, "INSERT INTO `tblbill` ( `billcode`, `fromadd`, `toadd`, `receiver`,`startdate`,  `items`, `cost`, `status`, `idCityFr`, `idCityTo`, `idClient`)
     VALUES ('$billCode','$data->frAddress','$data->toAddress','$data->receiver','$data->startDate','$data->items','$data->cost','$data->status','$data->idCityFr','$data->idCityTo','$data->idClient')");
    echo json_encode(array("billcode"=>$billCode));
    mysqli_close($con);
?>