<?php
        include "../model/database.php";
        function executeResultArray($con, $sql){
            $resultset = mysqli_query($con,$sql); // gui cau truy van toi db
            $list = [];
            while($row=mysqli_fetch_array($resultset,1)){ // tra ve ban ghi duoi dang mang
                $list[] = $row;
            }
            return $list;
        }
        $listResult=[];
        $result=executeResultArray($con,"SELECT * From tblcity");
        for( $i=0; $i<count($result); $i++){
            $code= $result[$i]['code'];
            $city= $result[$i]['name'];
            $list= executeResultArray($con,"SELECT * FROM tblbill WHERE idCityFr = '$code'");
            $listResult[$city]= count($list);
        }
        echo json_encode($listResult);
?>