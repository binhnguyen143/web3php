<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giao Hang</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <!-- navbar -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
      <div class="container-fluid">
        <a href="#" class="navbar-brand"><img src="assets/img/logo.svg" alt="">GIAO HÀNG NHANH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li><a class="nav-link scrollto active" href="#home">Trang chủ</a></li>
              <li><a class="nav-link scrollto " href="#services">Dịch vụ</a></li>
              <li><a class="nav-link scrollto " href="#news">Tin tức</a></li>
              <li><a class="nav-link scrollto " href="#footer">Liên hệ</a></li>
              <li><a class="btn" role="button" href="assets/php/view/loginpage.php">Đăng nhập</a></li>
          </ul>
        </div>
      </div>
    </nav> 
    <!-- home -->
    <section id="home" class="home ">
      <div class="container-fluid ">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item">
            <img src="assets/img/carousel/template1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item active">
            <img src="assets/img/carousel/template2.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="assets/img/carousel/template3.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        </div>
      </div>
    </section>
    <!-- estimate -->
    <section id="estimate" class="estimate">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="box">
              <h4><i class="bi bi-box-seam"></i>Theo dõivận đơn</h4>
              <img src="assets/img/pricing-business.png" class="w-100" alt="">
              <form>
                <input type="text" class="w-100 form-control" placeholder="" id="billcode">
                <a href="javascript:void(0)" class="btn" onclick="Check()" role="button">Tra cứu</a>
              </form>
              <div class="modal" tabindex="-1" id="modalbill" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Đơn hàng</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="bodybill">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="w-100 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box">
              <h4><i class="ri-scales-3-line"></i>Ước tính chi phí</h4>
                <form>
                  <label>Gửi từ</label>
                  <select id="frCity" class="form-select" onchange="fetchfrDistrict(this.value)" required>
                    <option value="">Chọn tỉnh/TP</option>
                    <?php
                      include "assets/php/model/database.php";
                      $res = mysqli_query($con,"SElECT * FROM tblcity ORDER BY code");
                      if(mysqli_num_rows($res) > 0){
                          while($row = mysqli_fetch_assoc($res)){
                              echo '<option value='.$row["code"].'>'.$row["name"].'</option>';
                          }
                      } else{
                          echo '<option>Không có tỉnh/TP</option>';
                      }
                    ?>
                  </select>
                  <select id="frDistrict" class="form-select">
                    <option value="">Chọn quận/huyện</option>
                  </select>
                  <label>Gửi đến</label>
                  <select id="toCity" class="form-select" onchange="fetchtoDistrict(this.value)" required>
                    <option value="">Chọn tỉnh/TP</option>
                    <?php
                      include "assets/php/model/database.php";
                      $res = mysqli_query($con,"SElECT * FROM tblcity ORDER BY code");  
                      if(mysqli_num_rows($res) > 0){
                          while($row = mysqli_fetch_assoc($res)){
                              echo '<option value='.$row["code"].'>'.$row["name"].'</option>';
                          }
                      } else{
                          echo '<option>Không có tỉnh/TP</option>';
                      }
                    ?>
                  </select>
                  <select id="toDistrict" class="form-select">
                    <option value="">Chọn quận/huyện</option>
                  </select>
                  <label>Cân nặng</label>
                  <input type="number" class="form-control" placeholder="gram" id="weight">
                  <div id="cal" ></div>
                  <a href="javascript:void(0)" class="btn" onclick="Esti()" role="button">Tính toán</a>
                </form>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box">
              <h4> <i class="bi bi-geo-alt"></i>Tìm bưu cục</h4>
              <img src="assets/img/features-3.png" class="w-100" alt="">
              <a href="#" class="btn" role="button">Tìm kiếm</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- services -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <p>DỊCH VỤ NỔI BẬT</p>
        </header>
        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/express.svg" class="img-fluid" alt="">
              <h3>Giao vận truyền thống</h3>
              <p>VCN</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="400">
              <img src="assets/img/eco.svg" class="img-fluid" alt="">
              <h3>Giao vận giá rẻ</h3>
              <p>VTK</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="600">
              <img src="assets/img/someday.svg" class="img-fluid" alt="">
              <h3>Giao vận hỏa tốc</h3>
              <p>VHT</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--count-->
    <section id="count" class="count d-flex align-items-center" data-aos="fade-up">
      <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
              <h1>Mạng lưới bưu cục trên 63 tỉnh thành.</h1>
              <hr></hr>
              <h5><b>Mạng lưới chi nhánh của Giao hàng nhanh</b> có mặt tại tất cả các tỉnh thành tại Việt Nam</h5>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <span class="text1" data-aos="fade-up" data-aos-delay="300"><i class="bi bi-people"></i> 321.897</span>
                <span class="text1" data-aos="fade-up" data-aos-delay="300"><i class="bi bi-truck"></i> 621890</span><br>
                <span class="text2" data-aos="fade-up" data-aos-delay="400">Khách hàng tin dùng</span> 
                <span class="text2" data-aos="fade-up" data-aos-delay="400">Vận đơn hoàn thành</span>
                <img src="assets/img/deco.png"  class="deco" alt="">
              
          </div>
        </div>
      </div>
    </section>
    <!--news-->
    <section id="news" class="news">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <p>TIN TỨC</p>
        </header>
        <div class="row">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="news-box">
              <div class="news-img"> <i class="ri-discuss-line icon"></i></div>
              <span class="news-date">T5, 15/4</span>
              <h3 class="news-title">Tin số 1</h3>
              <a href="#" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="news-box">
              <div class="news-img"><i class="ri-discuss-line icon"></i></div>
              <span class="news-date">T2, 11/4</span>
              <h3 class="news-title">Tin số 2</h3>
              <a href="#" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="news-box">
              <div class="news-img"><i class="ri-discuss-line icon"></i></div>
              <span class="news-date">CN, 14/3</span>
              <h3 class="news-title">Tin số 3</h3>
              <a href="#" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--footer-->
    <footer id="footer" class="footer">
      <div class="footer-newsletter">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
              <h4>NHẬN THÔNG BÁO MỚI NHẤT</h4>
              <p>Mô tả</p>
            </div>
            <div class="col-lg-6">
              <form action="" method="post">
                <input type="email" name="email"><input type="submit" value="Đăng ký">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-top">
        <div class="container" data-aos="fade-up" data-aos-delay="200">
          <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-info">
              <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.svg" alt="">
                <span>GIAO HÀNG NHANH</span>
              </a>
              <p>Mô tả</p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="mail"><i class="bi bi-envelope-fill bx bxl-envelope-fill"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin bx bxl-linkedin"></i></a>
              </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
              <h4>Links</h4>
              <ul>
                <li><i class="bi bi-chevron-right"></i> <a href="#home">Trang chủ</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#service">Dịch vụ</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Điều khoản</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#footer">Liên hệ</a></li>
              </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
              <h4>Our Services</h4>
              <ul>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Dịch vụ nội địa</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Dịch vụ quốc tế</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Dịch vụ Logistics</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Thương mại điện tử</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
              <h4>Contact Us</h4>
              <p>
                Đường:<br>
                Phường:<br>
                Quận:<br>
                TP:<br>
                <strong>SDT:</strong> xxx xxxx xxx<br>
                <strong>Email:</strong> info@example.com<br>
              </p>

            </div>

          </div>
        </div>
      </div>

      <div class="container">
        <div class="copyright">
          &copy; Bản quyền được đăng ký bởi <strong><span>Giao hàng nhanh</span></strong>
        </div>
        <div class="credits">
          Thiết kế bởi <a href="#">Bootstrap</a>
        </div>
      </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- JS file-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script>AOS.init();</script>
    <script>
        function fetchfrDistrict(code){
            $.ajax({
                type:"POST",
                url: "assets/php/controller/getDistrict.php",
                data: {cityCode: code },
                success: function(data){
                    $('#frDistrict').html(data);
                }
            });
        }
        function fetchtoDistrict(code){
            $.ajax({
                type:"POST",
                url: "assets/php/controller/getDistrict.php",
                data: {cityCode: code },
                success: function(data){
                    $('#toDistrict').html(data);
                }
            });
        }
        function Esti(){
          var from = $('#frCity').val();
          var to = $('#toCity').val();
          var weight = $('#weight').val();
          if(from != '' && to != '' && weight != ''){
            if(from == to){
            document.getElementById("cal").style.margin = "20px 0 -30px 0";
            document.getElementById('cal').innerHTML = "<p class=\"text-danger\"> Tạm tính chi phí: 15000 VND</p>";
            $('#cal').delay(3000).fadeOut('fast');
            } else{
            document.getElementById("cal").style.margin = "20px 0 -30px 0";
            document.getElementById('cal').innerHTML = "<p class=\"text-danger\"> Tạm tính chi phí: 30000 VND</p>";
            $('#cal').delay(3000).fadeOut('fast');
            }
          }
        }
    </script>
</body>
</html>