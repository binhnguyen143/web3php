<?php
    include "../model/database.php";
    $sum = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) as num FROM tblbill"));
    $res = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) as num FROM tblbill WHERE status = 0"));
    $res1 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) as num FROM tblbill WHERE status = 1"));
    $res2 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) as num FROM tblbill WHERE status = 2"));
    $res3 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) as num FROM tblbill WHERE status = 3"));
    echo "<tr>";
    echo "<td>".$sum['num']."</td>";
    echo "<td>".$res1['num']."</td>";
    echo "<td>".$res2['num']."</td>";
    echo "<td>".$res3['num']."</td>";
    echo "<td>".$res['num']."</td>";
    echo "</tr>";
    
        