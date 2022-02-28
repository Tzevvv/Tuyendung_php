<?php
ob_start();
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
$ID=$_GET['post'];
$select=$get_data->list_tintuc($ID);
$get_data->update_luotxem($ID);
foreach ($select as $se) {}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ニュースの詳細</title>
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
                        <h2>Detail Page</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Single Post Start-->
        <div class="single">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="single-content">
                           <?php $str =$se['DUONGDAN'];?>
                          <img src="<?php echo 'admin/' .str_replace(' ','',$str);?>">

                          <h2 style=" text-transform: uppercase; font-weight: bold;text-align:center;margin-bottom:50px;" ><?php echo $se['TIEUDE'] ?></h2>

                    <div class="row job_detail">
                        <div class="col-12 col-md-6 list-info">


                              <div class="line-icon mb-2 mb-10-mb align-center-md">
                                  <i class="fas fa-dollar-sign" style="width:18px; color:#103667"></i>
                                  <span class="pl-1 font500">Mức lương:</span>
                                  <span class="job_value"><?php echo $se['MUCLUONG'] ?></span>
                              </div>


                              <div class="line-icon mb-2 mb-10-mb align-center-md">
                                <i class="fa fa-briefcase fs-20 mr-1" style="width:18px;color:#103667"></i>
                                  <span class="pl-1 font500">Kinh nghiệm:</span>
                                  <span class="job_value"><?php echo $se['KINHNGHIEM'] ?></span>
                              </div>


                              <div class="line-icon mb-2 mb-10-mb align-center-md">
                                <i class="fas fa-graduation-cap fs-20 mr-1" style="width:18px;color:#103667"></i>
                                  <span class="pl-1 font500">Yêu cầu bằng cấp:</span>
                                  <span class="job_value"><?php echo $se['BANGCAP'] ?></span>
                              </div>


                              <div class="line-icon mb-2 mb-10-mb align-center-md">
                                  <i class="fas fa-users fs-20 mr-1" style="width:18px;color:#103667"></i>
                                  <span class="pl-1 font500">Số lượng cần tuyển:</span>
                                  <span class="job_value"><?php echo $se['SOLUONGTUYEN'] ?></span>
                              </div>


                              <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                  <i class="fas fa-user-tie fs-20 mr-1" style="width:18px;color:#103667"></i>
                                  <span class="pl-1 font500">Nghành nghề:</span>
                                  <span class="job_value"><?php echo $se['NGHANHNGHE'] ?></span>
                              </div>

                              <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                  <i class="fas fa-calendar-alt fs-20 mr-1" style="width:18px;color:#103667"></i>
                                  <span class="pl-1 font500">Ngày đăng:</span>
                                  <span class="job_value"><?php echo $se['NGAYDANG'] ?></span>
                              </div>


                           </div>
                           <div class="col-12 col-md-6 list-info pt-0-mb">

                             <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                 <i class="fas fa-map-marker-alt  fs-20 mr-1" style="width:18px;color:#103667"></i>
                                 <span class="pl-1 font500">Địa điểm làm việc:</span>
                                 <span class="job_value"><?php echo $se['DIACHI'] ?></span>
                             </div>

                             <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                 <i class="fas fa-user-tie fs-20 mr-1" style="width:18px;color:#103667"></i>
                                 <span class="pl-1 font500">Chức vụ:</span>
                                 <span class="job_value"><?php echo $se['CHUCVU'] ?></span>
                             </div>

                             <!-- <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                 <i class="fas fa-id-card-alt fs-20 mr-1" style="width:18px;color:#103667"></i>
                                 <span class="pl-1 font500">Hình thức làm việc:</span>
                                 <span class="job_value">3</span>
                             </div> -->

                             <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                 <i class="fas fa-clock fs-20 mr-1" style="width:18px;color:#103667"></i>
                                 <span class="pl-1 font500">Thời gian làm việc:</span>
                                 <span class="job_value"><?php echo $se['THOIGIANLAMVIEC'] ?></span>
                             </div>

                             <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                 <i class="fas fa-venus-mars fs-20 mr-1" style="width:18px;color:#103667"></i>
                                 <span class="pl-1 font500">Yêu cầu giới tính:</span>
                                 <span class="job_value"><?php echo $se['YEUCAUGIOITINH'] ?></span>
                             </div>

                             <div class="line-icon mb-2 mb-10-mb align-center-md" >
                                 <i class="fas fa-birthday-cake fs-20 mr-1" style="width:18px;color:#103667"></i>
                                 <span class="pl-1 font500">Yêu cầu độ tuổi:</span>
                                 <span class="job_value"><?php echo $se['YEUCAUTUOI'] ?></span>
                             </div>


                          </div>
                     </div>
                     <p style=" word-wrap: break-word;margin-top:50px;"><?php echo $se['MOTA'] ?></p>

                       </div>


                        <!-- <div class="single-tags">
                            <a href="">National</a>
                            <a href="">International</a>
                            <a href="">Economics</a>
                            <a href="">Politics</a>
                            <a href="">Lifestyle</a>
                            <a href="">Technology</a>
                            <a href="">Trades</a>
                        </div> -->


                        <div class="single-bio">
                            <div class="single-bio-img">
                                <img src="img/user.jpg" />
                            </div>
                            <div class="single-bio-text">
                                <h3>Author Name</h3>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Integer lorem augue purus mollis sapien, non eros leo in nunc. Donec a nulla vel turpis tempor ac vel justo. In hac platea dictumst.
                                </p>
                            </div>
                        </div>


                        <div class="single-related">
                            <h2>Related Post</h2>
                            <div class="owl-carousel related-slider">



                                <?php $select_topls=$get_data->select_tintuc_topluotxem(); foreach($select_topls as $se){ ?>

                                  <div class="post-item">
                                      <div class="post-img">
                                        <?php $str ='admin/'.$se['DUONGDAN']  ?>
                                          <img src="<?php echo str_replace(' ','',$str); ?>" alt="Image">
                                      </div>
                                      <div class="post-text">
                                          <a href="#"><?php echo $se['TIEUDE'] ?></a>
                                          <div class="post-meta">
                                              <p><?php echo substr ($se['MOTA'],0,30); ?>...</p>
                                          </div>
                                      </div>
                                  </div>

                                   <?php } ?>

                            </div>
                        </div>



                        <div class="single-comment">
                            <h2>Comments</h2>
                            <ul class="comment-list">


                              <?php $select_CM=$get_data->select_coment($ID); foreach($select_CM as $se){ ?>

                                <li class="comment-item">
                                    <div class="comment-body">
                                        <div class="comment-img">
                                            <img src="img/user.jpg" />
                                        </div>
                                        <div class="comment-text">
                                            <h3><a href=""><?php echo $se['name_cm'] ?></a></h3>
                                            <!-- <span>01 Jan 2045 at 12:00pm</span> -->
                                            <p>
                                                 <?php echo $se['noidung_cm'] ?>
                                            </p>
                                            <!-- <a class="btn" href="">Reply</a> -->
                                        </div>
                                    </div>
                                </li>

                                 <?php } ?>



                            </ul>
                        </div>
                        <div class="comment-form">
                            <h2>Leave a comment</h2>
                            <form action="" method="post"  enctype = "multipart/form-data">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input name="noidung" type="text" class="form-control" id="website">
                                </div>


                                <div class="form-group">
                                    <input type="submit" name="addcm" value="Post Comment" class="btn btn-custom">
                                </div>
                            </form>
                            <?php
                               if(isset($_POST['addcm'])){
                                 $tencm="user";
                                 $dk = $get_data->insert_comment($tencm,$_POST['noidung'],$ID);
                               }
                             ?>
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
                                    <a href="#"><img src="img/blog-1.jpg" alt="Image"></a>
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
                                    <a href="#"><img src="img/blog-2.jpg" alt="Image"></a>
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
                                    <a href="#"><img src="img/blog-3.jpg" alt="Image"></a>
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
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-contact">
                            <h2>Our Head Office</h2>
                            <p><i class="fa fa-map-marker-alt"></i>123 Street, New York, USA</p>
                            <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                            <p><i class="fa fa-envelope"></i>info@example.com</p>
                            <div class="footer-social">
                                <a class="btn btn-custom" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-custom" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-custom" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-custom" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-custom" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Popular Links</h2>
                            <a href="">About Us</a>
                            <a href="">Contact Us</a>
                            <a href="">Popular Causes</a>
                            <a href="">Upcoming Events</a>
                            <a href="">Latest Blog</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Useful Links</h2>
                            <a href="">Terms of use</a>
                            <a href="">Privacy policy</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-newsletter">
                            <h2>Newsletter</h2>
                            <form>
                                <input class="form-control" placeholder="Email goes here">
                                <button class="btn btn-custom">Submit</button>
                                <label>Don't worry, we don't spam!</label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="#">Your Site Name</a>, All Right Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
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
