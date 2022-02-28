<?php
ob_start();
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
$ID=$_GET['post'];
// include("ADMIN/singin_auth.php");

$get_data->update_luotxem($ID);

$ID2=0;
$ID2=$_GET['iddm'];
$slt=$get_data->select_tintuc_iddm($ID2);
foreach($slt as $selist){}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ホーム</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style11.css" rel="stylesheet">
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
                      <a href="index.php" class="nav-item nav-link active">ホーム</a>
                      <a href="about.php" class="nav-item nav-link ">企業採用者向け</a>
                      <a href="forjobseeker.php" class="nav-item nav-link">求職者向け</a>
                      <a href="map.php" class="nav-item nav-link">アクセス</a>
                      <a href="company.php" class="nav-item nav-link">会社概要</a>
                      <a href="blog.php" class="nav-item nav-link">お問い合わせ</a>
                      <a href="video.php"  <?php if (!isset($_SESSION['username']) || $_SESSION['PHANQUYEN']==2) { echo ' data-toggle="modal" data-target="#exampleModal"'; } ?>  class="nav-item nav-link">Video</a>
                      <a href="contact.php" class="nav-item nav-link">お問い合わせ</a>
                      <a href="question.php" class="nav-item nav-link">よくある質問</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->

        <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Điền mã video để truy cập trang web</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form  method="post">
                   <div class="modal-body">
                      <input type="text" class="form-control" name="idvideo" value="" placeholder="Mã video">
                   </div>
                   <div class="modal-footer">
                      <button type="submit" name="truycap" class="btn btn-primary">Save changes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   </div>
              </form>
            </div>
          </div>
          </div>
          <?php
              $user=$_SESSION['username'];
              if ($_SESSION['username']==""||$_SESSION['username']==null) {
                $user=" ";
              }
              else {
                if (isset($_POST['truycap'])) {
                  $dk=$get_data->kiemtraidvideo($_POST['idvideo'],$user);
                }
              }
           ?>
      <!-- Modal end -->


        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>ホーム</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>

                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Single Post Start-->
        <div class="single">
            <div class="container-fluid">
                <div class="row">
                <div class="col-lg-9"><div class="container">
                <div class="section-header text-center">
                    <h2>What's new</h2>
                </div>
                <div class="row">


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
                           <?php $str ='admin/'.$se['DUONGDAN']  ?>
                             <img src="<?php echo str_replace(' ','',$str); ?>" alt="Image"width="300px" height = "200px">
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

                    <div class="btn_all" style="text-align :center;"><a class="btn btn-custom2" style=""  href="blog.php">Show order Post</a></div>
                </div>


                <div class="introduct">
                    <div class="title">
                        <h2>introduct</h2>
                    </div>
                    <div class="row">


                        <div class="col-lg-6">
                            <a href="about.php"><img src="img/h38.jpg" alt="" width ="300px" height ="150px"></a>
                            <div class="img1">
                                <a href="about.php"><img src="img/ic1.png" alt="" style="border:5px solid white; " width="100px" height ="100px"></a>
                            </div>
                            <div class="t1">
                                <h2>採用担当者様へ - FOR RECRUITER</h2>
                            </div>
                        </div>

                        <div class="col-lg-6" >
                            <a href="forjobseeker.php"><img src="img/h39.jpg" alt="" width ="300px" height ="150px"></a>
                            <div class="img1">
                            <a href="forjobseeker.php"><img src="img/ic2.png" alt="" style="border:5px solid white; " width="100px" height ="100px"></a>
                            </div>
                            <div class="t1">
                                <h2>求職者様へ - FOR JOB SEEKER</h2>
                            </div>
                        </div>




                    </div>
                </div>
                <div class="textgt">
                    <p class="t22">
                    株式会社就職サポートのホームページをご覧になって頂きありがとうございます。当社は国内外にて外国人の方を中心とした外国人の就職サポートを行っております。
                    </p>
                </div>
            </div>


                    <div class="col-lg-3">
                        <div class="sidebar">
                            <!-- <div class="sidebar-widget">
                                <div class="search-widget">
                                    <form  class="timkiem" method="post">
                                        <input class="form-control" name="timkemkey" type="text" placeholder="Search Keyword">
                                        <button class="btn"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div> -->



                            <div class="sidebar-widget">
                                <h2 class="widget-title">New Post</h2>
                                <div class="recent-post">

                                    <?php $select_top5=$get_data->select_tintuc_top6($ID);
                                          foreach($select_top5 as $se){ ?>

                                      <div class="post-item">
                                        <a href="single.php?post=<?php echo $se['TID']?>">
                                          <div class="post-img">
                                            <?php $str ='admin/'.$se['DUONGDAN']  ?>
                                              <img src="<?php echo str_replace(' ','',$str); ?>" alt="Image">
                                          </div>
                                          <div class="post-text">
                                              <a href="single.php?post=<?php echo $se['TID']?>"><?php if(strlen($se['TIEUDE'])>15){echo substr ($se['TIEUDE'],0,15)."...";}else{echo ($se['TIEUDE']);}; ?></a>
                                              <div class="post-meta">
                                                  <p><?php if(strlen($se['MOTA'])>30){echo substr ($se['MOTA'],0,30)."...";}else{echo ($se['MOTA']);}; ?></p>
                                              </div>
                                          </div>
                                        </a>
                                      </div>

                                       <?php } ?>







                                </div>
                            </div>



                            <div class="sidebar-widget">
                                <div class="image-widget">
                                    <a href="#"><img src="img/h38.jfif"width ="234px" height ="159px" alt="Image"></a>
                                </div>
                            </div>




                            <div class="sidebar-widget">
                                <div class="tab-post">
                                  <?php  $date = getdate(); ?>
                                    <ul class="nav nav-pills nav-justified">

                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#featured"> DAY</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#popular">MONTH</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#latest">YEAR</a>
                                        </li>


                                    </ul>

                                    <div class="tab-content">
                                        <div id="featured" class="container tab-pane active">

                                          <?php $select_day_luotxem=$get_data->select_tintuc_luotxem_DAY_top5($date['year'].'-'.$date['mon'].'-'.$date['mday']);
                                                foreach($select_day_luotxem as $se_day_luotxem){ ?>
                                          <a href="single.php?post=<?php echo $se_day_luotxem['TID']?>">
                                            <div class="post-item">
                                                <div class="post-img">
                                                  <?php $str ='admin/'.$se_day_luotxem['DUONGDAN']  ?>
                                                    <img src="<?php echo str_replace(' ','',$str); ?>" alt="Image">
                                                </div>
                                                <div class="post-text">
                                                    <a href="single.php?post=<?php echo $se_day_luotxem['TID']?>"><?php if(strlen($se_day_luotxem['TIEUDE'])>15){echo substr ($se_day_luotxem['TIEUDE'],0,15)."...";}else{echo ($se_day_luotxem['TIEUDE']);}; ?></a>

                                                </div>
                                            </div>
                                          </a>
                                          <?php } ?>

                                        </div>
                                        <div id="popular" class="container tab-pane fade">


                                          <?php $select_mon_luotxem=$get_data->select_tintuc_luotxem_month_top5($date['mon']);
                                                foreach($select_mon_luotxem as $se_mon_luotxem){ ?>
                                          <a href="single.php?post=<?php echo $se_mon_luotxem['TID']?>">
                                            <div class="post-item">
                                                <div class="post-img">
                                                  <?php $str ='admin/'.$se_mon_luotxem['DUONGDAN']  ?>
                                                    <img src="<?php echo str_replace(' ','',$str); ?>" alt="Image">
                                                </div>
                                                <div class="post-text">
                                                    <a href="single.php?post=<?php echo $se_mon_luotxem['TID']?>"><?php if(strlen($se_mon_luotxem['TIEUDE'])>15){echo substr ($se_mon_luotxem['TIEUDE'],0,15)."...";}else{echo ($se_mon_luotxem['TIEUDE']);}; ?></a>

                                                </div>
                                            </div>
                                          </a>
                                          <?php } ?>

                                        </div>
                                        <div id="latest" class="container tab-pane fade">


                                          <?php $select_year_luotxem=$get_data->select_tintuc_luotxem_year_top5($date['year']);
                                                foreach($select_year_luotxem as $se_year_luotxem){ ?>
                                          <a href="single.php?post=<?php echo $se_year_luotxem['TID']?>">
                                            <div class="post-item">
                                                <div class="post-img">
                                                  <?php $str ='admin/'.$se_year_luotxem['DUONGDAN']  ?>
                                                    <img src="<?php echo str_replace(' ','',$str); ?>" alt="Image">
                                                </div>
                                                <div class="post-text">
                                                    <a href="single.php?post=<?php echo $se_year_luotxem['TID']?>"><?php if(strlen($se_year_luotxem['TIEUDE'])>15){echo substr ($se_year_luotxem['TIEUDE'],0,15)."...";}else{echo ($se_year_luotxem['TIEUDE']);}; ?></a>

                                                </div>
                                            </div>
                                          <?php } ?>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <div class="image-widget">
                                    <a href="#"><img src="img/h36.jfif" alt="Image"></a>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">Categories</h2>
                                <div class="category-widget">
                                    <ul>
                                      <?php $tk=$get_data->select_danhmuc();
                                            $stt=0; foreach($tk as $se){
                                      ?>

                                        <li><a href="blog.php?iddm=<?php $se['DMID'];?>"><?php ECHO $se['TENDM'];?></a><span></span></li>
                                        <!-- <li><a href="">International</a><span>(87)</span></li> -->

                                      <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <div class="image-widget">
                                    <a href="#"><img src="img/h37.jfif" alt="Image"></a>
                                </div>
                            </div>

                            <!-- <div class="sidebar-widget">
                                <h2 class="widget-title">Tags Cloud</h2>
                                <div class="tag-widget">
                                    <a href="">National</a>
                                    <a href="">International</a>
                                    <a href="">Economics</a>
                                    <a href="">Politics</a>
                                    <a href="">Lifestyle</a>
                                    <a href="">Technology</a>
                                    <a href="">Trades</a>
                                </div>
                            </div> -->

                            <!-- <div class="sidebar-widget">
                                <h2 class="widget-title">Text Widget</h2>
                                <div class="text-widget">
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Integer lorem augue purus mollis sapien, non eros leo in nunc. Donec a nulla vel turpis tempor ac vel justo. In hac platea nec eros. Nunc eu enim non turpis id augue.
                                    </p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Post End-->

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
