<?php
    include_once "../model/database.php";
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["tel"])){
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $name = $_POST["name"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $result = mysqli_query($con,"SELECT * FROM tbluser WHERE username ='".$username."'");
        if(mysqli_num_rows($result) > 0){
            echo json_encode(array("status"=>"201"));
        }
        else {
            mysqli_query($con, "INSERT INTO `tbluser`(`username`, `password`, `name`, `tel`, `email`, `address`, `position`) VALUES ('".$username."','".$password."','".$name."','".$tel."','".$email."','".$address."','client')");
            echo json_encode(array("status"=>"200"));
        }
    }
    mysqli_close($con);
?>

