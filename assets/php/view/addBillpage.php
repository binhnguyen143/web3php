<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm đơn</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/addBill.css">
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["username"]))
        {
            header("location: loginpage.php");
        }
        $id = $_SESSION["id"];
    ?> 
    <h2 class="mb-3 text-center">ĐƠN HÀNG MỚI</h2>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-10">    
            <form>
                <div class="col-10">
                    <label for="receiver" class="form-label">Người nhận</label>
                    <input type="text" class="form-control" id="receiver" placeholder="" required>
                </div>
                <div class="col-10">
                    <label for="toAddress" class="form-label">Địa chỉ lấy hàng</label>
                    <input type="text" class="form-control" id="frAddress" placeholder="" required>
                </div>
                <div class="row g-3">
                    <div class="col-sm-5">
                        <?php
                            include "../model/database.php";
                            $res = mysqli_query($con,"SElECT * FROM tblcity ORDER BY code");
                        ?>
                        <label for="frCity" class="form-label">Tỉnh/TP</label>
                        <select id="frCity" class="form-select" onchange="fetchfrDistrict(this.value)" required>
                            <option value="">Chọn tỉnh/TP</option>
                            <?php
                                if(mysqli_num_rows($res) > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        echo '<option value='.$row["code"].'>'.$row["name"].'</option>';
                                    }
                                } else{
                                    echo '<option>Không có tỉnh/TP</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-5">
                        <label for="frDistrict" class="form-label">Quận/Huyện</label>
                        <select id="frDistrict" class="form-select">
                            <option value="">Chọn quận/huyện</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-10">
                    <label for="toAddress" class="form-label">Địa chỉ giao hàng</label>
                    <input type="text" class="form-control" id="toAddress" placeholder="" required>
                </div>
                <div class="row g-3">
                    <div class="col-sm-5">
                        <?php
                            include "../model/database.php";
                            $res = mysqli_query($con,"SElECT * FROM tblcity ORDER BY code");
                        ?>
                        <label for="toCity" class="form-label">Tỉnh/TP</label>
                        <select id="toCity" class="form-select" onchange="fetchtoDistrict(this.value)" required>
                            <option value="">Chọn tỉnh/TP</option>
                            <?php
                                if(mysqli_num_rows($res) > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        echo '<option value='.$row["code"].'>'.$row["name"].'</option>';
                                    }
                                } else{
                                    echo '<option>Không có tỉnh/TP</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-5">
                        <label for="toDistrict" class="form-label">Quận/Huyện</label>
                        <select id="toDistrict" class="form-select">
                            <option value="">Chọn quận/huyện</option>
                        </select>
                    </div>
                </div>
                <div class="col-10">
                    <label for="text" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="tel" placeholder="">
                </div>
                <div class="col-10">
                    <label for="text" class="form-label">Nội dung đơn</label>
                    <textarea class="form-control" id="items" placeholder=""></textarea>
                </div>
                <hr class="col-10 my-4">
                <h5>Tiền thu người nhận</h5>

                <div class="my-3">
                    <div class="form-check">
                    <input id="paid" name="paymentMethod" type="radio" class="form-check-input" onclick="costhide()" checked required>
                    <label class="form-check-label" for="paid">Đã thanh toán</label>
                    </div>
                    <div class="form-check">
                    <input id="cod" name="paymentMethod" type="radio" class="form-check-input" onclick="costshow()" required>
                    <label class="form-check-label" for="cod">Dịch vụ thu hộ</label>
                    </div>
                </div>
                <div class="col-10">
                    <label for="text" class="form-label">Số tiền thu hộ</label>
                    <input type="number" class="form-control" id="cost" disabled>
                </div>
                <hr class="col-10 my-4">
                <div id="total"></div>
                <button class="col-10 btn btn-primary" type="button" id="confirm">Xác nhận</button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
    <script>
        function fetchfrDistrict(code){
            $.ajax({
                type:"POST",
                url: "../controller/getDistrict.php",
                data: {cityCode: code },
                success: function(data){
                    $('#frDistrict').html(data);
                }
            });
        }
        function fetchtoDistrict(code){
            $.ajax({
                type:"POST",
                url: "../controller/getDistrict.php",
                data: {cityCode: code },
                success: function(data){
                    $('#toDistrict').html(data);
                }
            });
        }
        function costhide(){
            document.getElementById("cost").disabled = true;
        }
        function costshow(){
            document.getElementById("cost").disabled = false;
        }
        $(document).ready(function(){
            $('#confirm').click(function(){
                var receiver = $('#receiver').val() +", "+$('#tel').val();
                var frAddress = $('#frAddress').val() + ", "+$('#frDistrict').val();
                var toAddress = $('#toAddress').val() + ", "+$('#toDistrict').val();
                var startdate = new Date().toISOString().slice(0,10);
                var items = $('#items').val();
                var cost = Number($('#cost').val());
                if($('#frCity').val() == $('#toCity').val()) cost += 15000;
                else cost += 30000;
                var idClient = '<?php echo $id?>';
                var idCityFr = $('#frCity').val();
                var idCityTo = $('#toCity').val();
                if($.trim(receiver).length>0 && $.trim(frAddress).length>0 && $.trim(toAddress).length>0 && $.trim(idClient).length>0 && $.trim(idCityFr).length>0 && $.trim(idCityTo).length>0)
                {
                    $.ajax({
                        type: "POST",
                        url: "../controller/clientAddBill.php",
                        data:{
                            data:JSON.stringify({
                                receiver: receiver,
                                frAddress: frAddress,
                                toAddress: toAddress,
                                startDate: startdate,
                                items: items,
                                cost: cost,
                                idClient: idClient,
                                idCityFr: idCityFr,
                                idCityTo: idCityTo,
                                status: 1
                            })
                        },
                        cache:false,
                        success: function(response){
                            response = JSON.parse(response);
                            console.log(response);
                            document.getElementById('total').innerHTML = '<p class="text-success">Thêm đơn thành công<br>Mã đơn: '+response.billcode+'<br> Tổng tiền thu: '+cost+'</p>';
                            window.location.href="clientpage.php";
                        }
                    });
                } else document.getElementById('total').innerHTML = '<p class="text-danger">Nhập đầy đủ thông tin</p>';
            });
        });
    </script>
</body>
</html>