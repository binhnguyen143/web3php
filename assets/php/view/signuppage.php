<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>

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
    <link href="../../css/signup.css" rel="stylesheet">
</head>
<body class="text-center">
  <main class="form-signup">
    <form method="POST" id="myform">
        <img class="mb-4" src="../../img/logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Đăng ký</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="username" placeholder="Tên đăng nhập" pattern="^[a-zA-Z]{1}[a-zA-Z0-9]+" title="Tên đăng nhập chỉ gồm chữ và số">
            <label for="username">Tên đăng nhập</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" pattern="^[a-zA-Z0-9]+" title="Mật khẩu không chứa ký tự đặc biệt">
            <label for="password">Mật khẩu</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="name" placeholder="Họ tên" title="Tên chỉ gồm chữ">
            <label for="name">Họ tên</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="tel" placeholder="Số điện thoại" pattern="^[0]{1}[0-9]+" title="SDT chỉ gồm só">
            <label for="tel">Số điện thoại</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="email" placeholder="Email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="address" placeholder="Địa chỉ">
            <label for="address">Địa chỉ</label>
        </div>
        <div class="form-group">
            <input type="button" name="signup" id="signup" class="btn btn-primary" value="Đăng ký" />
        </div>
        <p id="error"> </p>
    </form>   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $('#signup').click(function(){
          var username = $('#username').val();
          var password = $('#password').val();
          var name = $('#name').val();
          var tel = $('#tel').val();
          var email = $('#email').val();
          var address = $('#address').val();
          if($.trim(username).length >0 && $.trim(password).length >0 && $.trim(name).length >0 && $.trim(tel).length >0){
            $.ajax({
              url: "../controller/signup.php",
              type: "POST",
              data: {
                username: username,
                password: password,
                name: name,
                tel: tel,
                email: email,
                address: address
              },
              cache: false,
              success: function(data){
                data = JSON.parse(data);
                console.log(data.status);
                if(data.status == "200"){
                  document.getElementById("error").innerHTML="Đăng ký thành công";
                  document.getElementById("error").style.color = "green";
                  document.getElementById("myform").reset();
                  window.location.href="loginpage.php";
                } else{
                  document.getElementById("error").innerHTML="Đã tồn tại tên đăng nhập";
                  document.getElementById("error").style.color = "red";
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