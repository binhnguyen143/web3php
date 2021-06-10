<?php
    include_once "../model/database.php";
    session_start();
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $username = mysqli_real_escape_string($con,$_POST["username"]);
        $password = md5(mysqli_real_escape_string($con,$_POST["password"]));
        $result = mysqli_query($con, "SELECT * FROM tbluser WHERE username = '".$username."' AND password = '".$password."'");
        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_array($result);
            $_SESSION["username"] = $data["username"];
            $_SESSION["id"] = $data["id"];
            echo json_encode(array("id"=>$data["id"], "username"=>$data["username"], "position"=>$data["position"], "status"=>"200"));
        } else{
            echo json_encode(array("status"=>"201"));
        }
    }
    mysqli_close($con);
?>