<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Người vận chuyển</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/client.css">
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["username"]))
        {
            header("location: loginpage.php");
        }
    ?> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="../../img/logo.svg" alt=""></a>
        <div class="dropdown ms-auto">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../../img/icon.png" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item" href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../controller/logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>
    <div class="text-center">
    <input class="btn btn-primary" type="button" name="add" id="add" value="Nhận đơn">
        <input class="btn btn-success" type="button" name="finish" id="finish" value="Hoàn thành đơn">
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <table class="table table-striped table-bordered table-hover">
                <caption></caption>
                <thead>
                    <tr>
                    <th scope="col" class="text-center"><input type="checkbox" id="select_all"></th>
                    <th scope="col">#</th>
                    <th scope="col">Mã vận đơn</th>
                    <th scope="col">Ngày nhận</th>
                    <th scope="col">Ngày hoàn thành</th>
                    <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody id="bodytable">
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var id = '<?php echo $_SESSION["id"];?>';
            $.ajax({
                type: "GET",
                url: '../controller/getshipperbills.php',
                data:{ idShipper: id},
                cache:false,
                success: function(response){
                    $('#bodytable').html(response);
                }
            });
            $('#select_all').on('click', function(){
                $(':checkbox').prop("checked",$(this).is(':checked'));
            });
            $('#add').click(function(){
                var selected =[];
                var idShipper = '<?php echo $_SESSION["id"]; ?>'
                $('input[type="checkbox"]:checked').each(function(){
                    id = $(this).attr("id");
                    if(id !="select_all") selected.push(id);
                })
                var claimdate = new Date().toISOString().slice(0,10);
                $.ajax({
                    type: "POST",
                    url: "../controller/shipperAddBill.php",
                    data:{
                        selected: selected,
                        idShipper: idShipper,
                        claimdate: claimdate
                    },
                    success: function(data){
                       location.reload();
                    }
                });
            })
            $('#finish').click(function(){
                var selected =[];
                var idShipper = '<?php echo $_SESSION["id"]; ?>'
                $('input[type="checkbox"]:checked').each(function(){
                    id = $(this).attr("id");
                    if(id !="select_all") selected.push(id);
                })
                var finishdate = new Date().toISOString().slice(0,10);
                $.ajax({
                    type: "POST",
                    url: "../controller/shipperDone.php",
                    data:{
                        selected: selected,
                        idShipper: idShipper,
                        finishdate: finishdate
                    },
                    success: function(data){
                       location.reload();
                    }
                });
            })
        })
    </script>
</body>