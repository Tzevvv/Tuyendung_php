<?php
ob_start();
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class


$ID=0;
$ID=$_GET['iddm'];
$slt=$get_data->select_tintuc_iddm($ID);
foreach($slt as $selist){}


  //BƯỚC 1: KẾT NỐI SQL
  // BƯỚC 2: TÌM TỔNG SỐ RECORDS
  $result = mysqli_query($conn, 'select count(TID) as total from tintuc');
  $row = mysqli_fetch_assoc($result);
  $total_records = $row['total'];

  // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = 10;

  // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
  // tổng số trang
  $total_page = ceil($total_records / $limit);

  // Giới hạn current_page trong khoảng 1 đến total_page
  if ($current_page > $total_page){
      $current_page = $total_page;
  }
  else if ($current_page < 1){
      $current_page = 1;
  }
  // Tìm Start
  $start = ($current_page - 1) * $limit;

  // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
  // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
  $result = mysqli_query($conn, "SELECT * FROM tintuc LIMIT $start, $limit");
?>


<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>お問い合わせ</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">


        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="colorlib.com">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
        <link href="css/main2.css" rel="stylesheet" />

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
                <a href="index.html" class="navbar-brand">株式会社就職サポート</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                    <a href="index.php" class="nav-item nav-link">ホーム</a>
                      <a href="about.php" class="nav-item nav-link ">企業採用者向け</a>
                      <a href="forjobseeker.php" class="nav-item nav-link">求職者向け</a>
                      <a href="access.php" class="nav-item nav-link">アクセス</a>
                      <a href="company.php" class="nav-item nav-link">会社概要</a>
                      <a href="blog.php" class="nav-item nav-link active">お問い合わせ</a>
                      <a href="video.php" class="nav-item nav-link">Video</a>
                      <a href="contact.php" class="nav-item nav-link">お問い合わせ</a>
                      <a href="question.php" class="nav-item nav-link">よくある質問</a>
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
                        <h2>From Blog</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Blog</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Blog Start -->
        <div class="blog">
            <div class="container">
                <div class="section-header text-center">
                    <p>Our Blog</p>
                    <h2>Latest news & articles directly from our blog</h2>
                </div>
                <div class="s130" >
                  <form method="post">
                    <div class="inner-form">
                      <div class="input-field first-wrap">
                        <div class="svg-wrapper">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                          </svg>
                        </div>
                        <input id="search" name="timkemkey" type="text" placeholder="Tìm kiếm từ khóa" />
                      </div>
                      <div class="input-field second-wrap">
                        <button style="" type="submit" name="timkiem" class="btn-search">SEARCH</button>
                      </div>
                    </div>
                  </form>
                </div>


                <div class="row">
                  <?php
                  if ($ID==null) {
                    $select=$result;
                  }
                  else {
                    $select=$selist;
                  } ?>


                  <?php if (isset($_POST['timkiem'])) {$select=$get_data->search_tin($_POST['timkemkey']);
                  foreach ($select as $se) {
                  ?>
                  <div class="col-lg-4" style="margin-bottom:50px;">
                      <div class="event-item">
                          <img src="img/event-1.jpg" alt="Image" width="300px" height = "200px">
                          <div class="event-content" style="padding:5px">
                              <div class="event-meta row" >
                                  <div class="col-6">
                                    <p><i class="fa fa-calendar-alt"></i><?php echo $se['NGAYDANG'] ?></p>
                                    <p><i class="far fa-clock"></i><?php echo $se['THOIGIANLAMVIEC'] ?></p>
                                    <p><i class="fa fa-map-marker-alt"></i><?php echo $se['DIACHI'] ?></p>
                                  </div>
                                  <div class="col-6">
                                    <p><i class="fas fa-venus-mars"></i><?php echo $se['YEUCAUGIOITINH'] ?></p>
                                    <p><i class="fas fa-birthday-cake"></i><?php echo $se['YEUCAUTUOI'] ?></p>
                                    <p><i class="fas fa-dollar-sign"></i><?php echo $se['MUCLUONG'] ?></p>
                                  </div>
                              </div>
                              <div class="event-text">
                                  <h3><?php if(strlen($se['TIEUDE'])>30){echo substr ($se['TIEUDE'],0,30)."...";}else{echo ($se['TIEUDE']);}; ?></h3>
                                  <p>
                                    <?php if(strlen($se['MOTA'])>30){echo substr ($se['MOTA'],0,30)."...";}else{echo ($se['MOTA']);}; ?>
                                  </p>
                                  <a class="btn btn-custom" style="margin-top:15px;" href="single.php?post=<?php echo $se['TID']?>">Join Now</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <?php
                }
              }else {
                     $select=$get_data->select_tintuc_top6();
                     foreach ($select as $se) {
                     ?>
                     <div class="col-lg-4" style="margin-bottom:50px;">
                         <div class="event-item">
                             <img src="img/event-1.jpg" alt="Image" width="300px" height = "200px">
                             <div class="event-content" style="padding:5px">
                                 <div class="event-meta row" >
                                     <div class="col-6">
                                       <p><i class="fa fa-calendar-alt"></i><?php echo $se['NGAYDANG'] ?></p>
                                       <p><i class="far fa-clock"></i><?php echo $se['THOIGIANLAMVIEC'] ?></p>
                                       <p><i class="fa fa-map-marker-alt"></i><?php echo $se['DIACHI'] ?></p>
                                     </div>
                                     <div class="col-6">
                                       <p><i class="fas fa-venus-mars"></i><?php echo $se['YEUCAUGIOITINH'] ?></p>
                                       <p><i class="fas fa-birthday-cake"></i><?php echo $se['YEUCAUTUOI'] ?></p>
                                       <p><i class="fas fa-dollar-sign"></i><?php echo $se['MUCLUONG'] ?></p>
                                     </div>
                                 </div>
                                 <div class="event-text">
                                     <h3><?php if(strlen($se['TIEUDE'])>30){echo substr ($se['TIEUDE'],0,30)."...";}else{echo ($se['TIEUDE']);}; ?></h3>
                                     <p>
                                       <?php if(strlen($se['MOTA'])>30){echo substr ($se['MOTA'],0,30)."...";}else{echo ($se['MOTA']);}; ?>
                                     </p>
                                     <a class="btn btn-custom" style="margin-top:15px;" href="single.php?post=<?php echo $se['TID']?>">Join Now</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <?php
                     }
                } ?>




                 </div>




                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="pagination justify-content-center">
                          <?php
                   // PHẦN HIỂN THỊ PHÂN TRANG
                   // BƯỚC 7: HIỂN THỊ PHÂN TRANG
                   // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
                   if ($current_page > 1 && $total_page > 1){
                           echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="blog.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
                   }
                   // Lặp khoảng giữa
                   for ($i = 1; $i <= $total_page; $i++){
                       // Nếu là trang hiện tại thì hiển thị thẻ span
                       // ngược lại hiển thị thẻ a
                       if ($i == $current_page){
                           echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
                       }
                       else{
                           echo ' <li class="page-item"><a class="page-link" href="blog.php?page='.$i.'">'.$i.'</a></li> ';
                       }
                   }
                   // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                   if ($current_page < $total_page && $total_page > 1){
                          echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="blog.php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
                   }
                  ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->


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
        <script src="js/extention/choices.js"></script>

    </body>
</html>
