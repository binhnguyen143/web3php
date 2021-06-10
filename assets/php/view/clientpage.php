<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng</title>
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
        $id = $_SESSION['id'];
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
        <a class="btn btn-primary" type="button" href="addBillpage.php">Thêm đơn</a>
        <input class="btn btn-danger" type="button" name="delete" id="delete" value="Hủy đơn">
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
                    <th scope="col">Ngày gửi</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="bodytable">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">SỬA ĐƠN</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form>
                <div class="col-12">
                    <label for="receiver" class="form-label">Người nhận</label>
                    <input type="text" class="form-control" id="receiver" placeholder="" required>
                </div>
                <div class="col-12">
                    <label for="toAddress" class="form-label">Địa chỉ lấy hàng</label>
                    <input type="text" class="form-control" id="frAddress" placeholder="" required>
                </div>
                <div class="row g-3">
                    <div class="col-sm-6">
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

                    <div class="col-sm-6">
                        <label for="frDistrict" class="form-label">Quận/Huyện</label>
                        <select id="frDistrict" class="form-select">
                            <option value="">Chọn quận/huyện</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-12">
                    <label for="toAddress" class="form-label">Địa chỉ giao hàng</label>
                    <input type="text" class="form-control" id="toAddress" placeholder="" required>
                </div>
                <div class="row g-3">
                    <div class="col-sm-6">
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

                    <div class="col-sm-6">
                        <label for="toDistrict" class="form-label">Quận/Huyện</label>
                        <select id="toDistrict" class="form-select">
                            <option value="">Chọn quận/huyện</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="text" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="tel" placeholder="">
                </div>
                <div class="col-12">
                    <label for="text" class="form-label">Nội dung đơn</label>
                    <textarea class="form-control" id="items" placeholder=""></textarea>
                </div>
                <hr class="col-12 my-4">
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
                <div class="col-12">
                    <label for="text" class="form-label">Số tiền thu hộ</label>
                    <input type="number" class="form-control" id="cost" disabled>
                </div>
                <hr class="col-12 my-4">
                <div id="total"></div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button class="btn btn-primary" type="button" id="confirm">Xác nhận</button>
        </div>
        </div>
    </div>
    </div>
    <script>   
        function editData(id){
            $.ajax({
                type: "GET",
                url: "../controller/get1bill.php",
                data: {id: id},
                success: function(data){
                    data = JSON.parse(data);
                    info = data.receiver.split(',');
                    from = data.fromadd.split(',');
                    to = data.toadd.split(',');
                    $('#receiver').val(info[0]);
                    $('#frAddress').val(from[0]);
                    $('#frCity').val(data.idCityFr);
                    fetchfrDistrict(data.idCityFr);
                    $('#frDistrict').val(from[1]);
                    $('#toAddress').val(to[0]);
                    $('#toCity').val(data.idCityTo);
                    fetchtoDistrict(data.idCityTo);
                    $('#toDistrict').val(to[1]);
                    $('#tel').val(info[1]);
                    $('#items').val(data.items);
                    if(data.idCityFr == data.idCityTo && Number(data.cost) > 15000) {
                        document.getElementById('cod').checked = true;
                        document.getElementById("cost").disabled = false;
                        $('#cost').val(Number(data.cost) - 15000);
                    } 
                    if(data.idCityFr != data.idCityTo && Number(data.cost) > 30000)
                    {
                        document.getElementById('cod').checked = true;
                        document.getElementById("cost").disabled = false;
                        $('#cost').val(Number(data.cost) - 30000);
                    }
                    $('#updateModal').modal('show');
                    document.getElementById("confirm").onclick = function() {
                        var billcode = data.billcode;
                        var receiver = $('#receiver').val() +", "+$('#tel').val();
                        var frAddress = $('#frAddress').val() + ", "+$('#frDistrict').val();
                        var toAddress = $('#toAddress').val() + ", "+$('#toDistrict').val();
                        var items = $('#items').val();
                        var cost = Number($('#cost').val());
                        if($('#frCity').val() == $('#toCity').val()) cost += 15000;
                        else cost += 30000;
                        var idCityFr = $('#frCity').val();
                        var idCityTo = $('#toCity').val();
                        if($.trim(receiver).length>0 && $.trim(frAddress).length>0 && $.trim(toAddress).length>0 && $.trim(idCityFr).length>0 && $.trim(idCityTo).length>0)
                        {
                            $.ajax({
                                type: "POST",
                                url: "../controller/updateBill.php",
                                data:{
                                    data: JSON.stringify({
                                        billcode: billcode,
                                        receiver: receiver,
                                        frAddress: frAddress,
                                        toAddress: toAddress,
                                        items: items,
                                        cost: cost,
                                        idCityFr: idCityFr,
                                        idCityTo: idCityTo,
                                    })
                                },
                                cache:false,
                                success: function(data){
                                    data =JSON.parse(data);
                                    document.getElementById('total').innerHTML = '<span class="text-success">'+data.msg+'</span>';
                                    $('#total').delay(1000).fadeOut('fast');
                                    setTimeout(function() { $('#updateModal').modal('hide'); }, 2000);
                                }

                            });
                        }
                    };
                }
            });
        }
        
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
            var id = '<?php echo $id?>';
            $.ajax({
                type: "GET",
                url: '../controller/getclientbills.php',
                data:{ idClient: id},
                cache:false,
                success: function(response){
                    $('#bodytable').html(response);
                }
            });
            $('#select_all').on('click', function(){
                $(':checkbox').prop("checked",$(this).is(':checked'));
            });
            $('#delete').click(function(){
                var selected =[];
                $('input[type="checkbox"]:checked').each(function(){
                    id = $(this).attr("id");
                    if(id !="select_all") selected.push(id);
                })
                console.log(selected);
                $.ajax({
                    type: "POST",
                    url: "../controller/deleteBill.php",
                    data:{selected: selected},
                    success: function(data){
                        // location.reload();
                    }
                });
            })
        })
    </script>
</body>
</html>