<?php
    include "../model/database.php";
    if ($_POST["cityCode"]){
        $res = mysqli_query($con, "SELECT * FROM tbldistrict WHERE cityCode ='".$_POST["cityCode"]."'");
        if(mysqli_num_rows($res)){
            while ($row = mysqli_fetch_assoc($res)){
                echo '<option value='.$row["code"].'>'.$row["name"].'</option>';
            }
        } else{
            echo '<option>Không có quận/huyện</option>';
        }
    }