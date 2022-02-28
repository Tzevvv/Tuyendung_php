<?php
ob_start();
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
$ID=$_GET['post'];

$get_data->update_luotxem($ID);

$ID2=0;
$ID2=$_GET['iddm'];
$slt=$get_data->select_tintuc_iddm($ID2);
foreach($slt as $selist){}

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>お問い合わせ</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
      <!-- Top Bar Start -->
      <div class="top-bar d-none d-md-block">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-9">
                      <div class="top-bar-left">
                          <div class="text">
                              <p>
                              <?php
                               session_start();
                               if(isset($_SESSION["username"])){ echo 'こんにちは : '.$_SESSION['username'];
                              }?></p>
                          </div>

                          <?php
                           session_start();
                           if(isset($_SESSION["username"])){

                             if($_SESSION["PHANQUYEN"]<2){
                             ?>
                             <div class="text" style="width:200px;">
                                 <div class="social">
                                    <a style="color:white; width:200px;" href="ADMIN/hoadon.php"> 管理ページ </a>
                                 </div>
                             </div>
                             <?php
                          }}?>

                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="top-bar-right">
                          <div class="social">
                            <?php if(isset($_SESSION["username"])){?>
                              <a href="ADMIN/singout.php" style="width:100px;"><img src="https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-log-out-user-interface-kmg-design-outline-color-kmg-design.png"/>Logout</a><?php
                            } ?>

                            <?php if(!isset($_SESSION["username"])){?>
                              <a href="ADMIN/login.php" style="width:100px;"><img src="https://img.icons8.com/color/48/000000/user-male.png"/>Login</a><?php
                            } ?>


                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.html" class="navbar-brand">Helpz</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                    <a href="index.php" class="nav-item nav-link">ホーム</a>
                      <a href="about.php" class="nav-item nav-link ">企業採用者向け</a>
                      <a href="forjobseeker.php" class="nav-item nav-link">求職者向け</a>
                      <a href="map.php" class="nav-item nav-link">アクセス</a>
                      <a href="company.php" class="nav-item nav-link">会社概要</a>
                      <a href="blog.php" class="nav-item nav-link">お問い合わせ</a>
                      <a href="video.php" class="nav-item nav-link">Video</a>
                      <a href="contact.php" class="nav-item nav-link active">お問い合わせ</a>
                      <a href="question.php" class="nav-item nav-link">よくある質問</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->


        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Contact Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Get In Touch</p>
                    <h2>Contact for any query</h2>
                </div>
                <div class="contact-img">
                    <img src="img/contact.jpg" alt="Image">
                </div>
                <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="control-group">
                                <input type="text" class="form-control" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-custom" type="submit" id="sendMessageButton">Send Message</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <!-- Contact End -->


      <!-- Footer Start -->
      <style media="screen">
           .footer-new a{
              font-weight:500;color:white;
           }
           .footer-new a:hover{
              color:#FDBE33;
              transition: .3s;
           }
           .footer-new a:hover {
               color: #FDBE33;
               letter-spacing: 1px;
           }
        </style>

       <style media="screen">
           .footer-new a{
              font-weight:500;color:white;
           }
           .footer-new a:hover{
              color:#FDBE33;
              transition: .3s;
           }
           .footer-new a:hover {
               color: #FDBE33;
               letter-spacing: 1px;
           }
        </style>
        <div class="footer">
            <div class="container">
                <div class="row" >

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link ">
                            <h2>MENU</h2>
                            <a href="">Home</a>
                            <a href="">求人企業様へ</a>
                            <a href="">求職者様へ</a>
                            <a href="">会社概要</a>
                            <a href="">Blog</a>
                            <a href="">お問い合わせ</a>
                            <a href="">よくある質問</a>
                            <a href="">Video</a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-contact footer-new">
                            <h2 style=" text-align: center;">WHAT NEW</h2>

                            <div class="row" style="padding-left:50px;margin-bottom:20px;">
                               <div class="col-2">
                                  <div class="row" style="width:50px;height:50px; text-align: center;border-radius:10px;border:2px solid white;">
                                       <span style="font-weight:bold;font-size:15px;padding:2px;color:white;">01-12-2000</span><br>
                                  </div>
                               </div>
                               <div class="col-8">
                                 <a href="#"  style=""><p > 大阪支店 大阪支店 大阪支店 :</p> </a>
                               </div>
                            </div>



                            <a href="" class="" style="text-align:center;"> <p><i class="fas fa-angle-double-right"></i>  show more</p> </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6" style=" text-align: center;">
                        <div class="footer-contact">
                            <h2>COMPANY FILE</h2>
                            <h3>株式会社就職サポート</h3>
                            <p> 大阪支店 :</p>
                            <p><i class="fa fa-phone-alt"></i>Tel: 03－5604－9180 </p>
                            <p><i class="fa fa-envelope"></i>Fax: 03－5604－9181</p>
                            <p><i class="fa fa-map-marker-alt"></i>住所:〒110-0005</p>

                            <h3>東京都台東区上野５－７－７公徳堂ビル5階501室</h3>
                            <p>大阪支店 :</p>
<p><i class="fa fa-phone-alt"></i>Tel:06－6829ー6822</p>
                            <p><i class="fa fa-envelope"></i>Fax:06－6829－68231</p>
                            <p><i class="fa fa-map-marker-alt"></i>住所:〒532-0011 </p>
                            <p> 大阪市淀川区西中島６丁目９－２０ 大阪GHビル３０５号</p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="#">Your Site Name</a>, All Right Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p>Designed By <a href="">THANH TUNG - QUANG DUAN</a></p>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- Footer End -->

        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/parallax/parallax.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
