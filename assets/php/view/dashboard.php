<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị viên</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>    
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        // Create columns for the DataTable
        data.addColumn('string');
      data.addColumn('number', 'City');
      // Create Rows with data
        var datajson=$.ajax({
          url:"../controller/getData.php",
          dataType:"json",
          async: false
        }).responseText;
        var jsondata= JSON.parse(datajson);
        data.addRows(Object.entries(jsondata));
      //Create option for chart
        var options = {
          title: 'BIỂU ĐỒ THỐNG KÊ ĐƠN HÀNG ĐƯỢC GỬI ĐI THEO TỈNH/THÀNH PHỐ',
          'width': 1000,
          'height': 800,
          is3D: true
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
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
  <div class="row">
    <div class="col-2"></div>
    <div class="col-10">
      <div id="chart_div"></div>
      <h2>BẢNG THỐNG KÊ ĐƠN HÀNG </h2>
      <div class="col-10 table-responsive">
        <table class="table table-striped table-sm">
          <caption></caption>
          <thead>
            <tr>
              <th scope="col">Tổng số đơn</th>
              <th scope="col">Số đơn đã lưu kho</th>
              <th scope="col">Số đơn đang giao</th>
              <th scope="col">Số đơn đã giao</th>
              <th scope="col">Số đơn đã hủy</th>
            </tr>
          </thead>
          <tbody id="tablebody">
          </tbody>
        </table>
        </div> 
      </div>
  </div>
  <script>
  $.ajax({
    type: "GET",
    url: "../controller/getStat.php",
    cache: false,
    success: function(data){
      $('#tablebody').html(data);
    }
  })
  </script>
</body>
</html>
