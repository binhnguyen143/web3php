<?php
    include "../model/database.php";
    $id = $_GET["idClient"];
    $res = mysqli_query($con, "SELECT id,billcode, startdate,status FROM tblbill WHERE idClient=$id");
    if(mysqli_num_rows($res)>0){
        $order = 1;
        while($row = mysqli_fetch_assoc($res)){
            echo '<tr id="'.$order.'">';
            echo '<td class="text-center"><input type="checkbox" id="'.$row["id"].'"></td>';
            echo "<td>$order</td>";
            echo '<td data-target="billcode">'.$row["billcode"].'</td>';
            echo '<td>'.$row["startdate"].'</td>';
            switch($row["status"]){
                case "1":
                    echo '<td class="text-primary">Đã lưu kho</td>';
                    echo '<td class="text-center"><a type="button" class="btn btn-warning" href="javascript:void(0)" onclick="editData('.$row["id"].')">Sửa đơn</a></td>';
                    break;
                case "0":
                    echo '<td class="text-danger">Đã hủy</td>';
                    echo '<td></td>';
                    break;
                case "2":
                    echo '<td class="text-warning">Đang giao hàng</td>';
                    echo '<td></td>';
                    break;
                case "3":
                    echo '<td class="text-success">Đã giao hàng</td>';
                    echo '<td></td>';
                    break;
                default:
                    echo '<td></td><td></td>';
            }
            echo "</tr>";
            $order +=1;
        }
    }