<?php
    include "../model/database.php";
    $id = $_GET["idShipper"];
    $res = mysqli_query($con, "SELECT id,billcode, claimdate, finishdate, status FROM tblbill WHERE idShipper=$id OR idShipper IS NULL");
    if(mysqli_num_rows($res)>0){
        $order = 1;
        while($row = mysqli_fetch_assoc($res)){
            echo '<tr id="'.$order.'">';
            echo '<td class="text-center"><input type="checkbox" id="'.$row["id"].'"></td>';
            echo "<td>$order</td>";
            echo '<td data-target="billcode">'.$row["billcode"].'</td>';
            echo '<td>'.$row["claimdate"].'</td>';
            echo '<td>'.$row["finishdate"].'</td>';
            switch($row["status"]){
                case "1":
                    echo '<td >Chưa nhận</td>';
                    break;
                case "0":
                    echo '<td class="text-danger">Đã hủy</td>';
                    break;
                case "2":
                    echo '<td class="text-primary">Đang nhận</td>';
                    break;
                case "3":
                    echo '<td class="text-success">Đã hoàn thành</td>';
                    break;
                default:
                    echo '<td></td>';
            }
            echo "</tr>";
            $order +=1;
        }
    }