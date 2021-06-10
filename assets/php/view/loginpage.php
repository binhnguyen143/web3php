<?php
  session_start();
  include "../model/database.php";
  if(isset($_SESSION["id"])){
    $res = mysqli_query($con,"SELECT position FROM tbluser WHERE id = '".$_SESSION["id"]."'");  
    if($res == "admin") {
      header("location: dashboard.php");
    } else if($res == "client") {
      header("location: clientpage.php");
    } else if($res == "shipper") {
      header("location: shipperpage.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
    <link href="../../css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
  <main class="form-signin">
    <form method="POST">
        <img class="mb-4" src="../../img/logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Đăng nhập</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="username" placeholder="Tên đăng nhập" pattern="^[a-zA-Z]{1}[a-zA-Z0-9]+" title="Tên đăng nhập chỉ gồm chữ và số">
            <label for="username">Tên đăng nhập</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" pattern="^[a-zA-Z0-9]+" title="Mật khẩu không chứa ký tự đặc biệt">
            <label for="password">Mật khẩu</label>
        </div>
        <div class="form-group">
            <input type="button" name="login" id="login" class="btn btn-primary" value="Đăng nhập" />
        </div>
        <div id="error"></div>
        <label class="signup">Chưa có tài khoản?<a href="signuppage.php">Đăng ký ngay</a></label>
    </form>   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $('#login').click(function(){
          var username = $('#username').val();
          var password = $('#password').val();
          if($.trim(username).length >0 && $.trim(password).length >0){
            $.ajax({
              url: "../controller/login.php",
              type: "POST",
              data: {
                username: username,
                password: password
              },
              cache: false,
              success: function(data){
                data = JSON.parse(data);
                if(data.status == "200"){
                  if(data.position == "client"){
                    window.location.href = "clientpage.php";
                  } else if(data.position == "admin"){
                    window.location.href = "dashboard.php";
                  } else if(data.position == "shipper"){
                    window.location.href = "shipperpage.php";
                  }
                } else{
                  $('#error').html("<span class='text-danger'>Sai tên đăng nhập hoặc mật khẩu</span>");
                }
              }
            });
          }else{
            return false;
          }
        });
      });
    </script>
  </main>
</body>
</html>