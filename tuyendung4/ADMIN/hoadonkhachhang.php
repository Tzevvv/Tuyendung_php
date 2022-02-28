

<?php

error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt=$get_data->list_hoso($ID);

$del=$_GET['del'];
$dk = $get_data->delete_hoso($del);





foreach($slt as $selist){}



  //BƯỚC 1: KẾT NỐI SQL
  // BƯỚC 2: TÌM TỔNG SỐ RECORDS
  $result = mysqli_query($conn, 'select count(VISAID) as total from visa');
  $row = mysqli_fetch_assoc($result);
  $total_records = $row['total'];

  // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = 50;

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
  $result = mysqli_query($conn, "SELECT *, (SELECT NAMENV from nhanvien WHERE NVID=NV2ID) as NAMENV2 FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID LIMIT $start, $limit");
   ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TZEV - Coffee </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Customized Bootstrap Stylesheet -->
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css\csss3.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

    <link href="assets/css/paper-dashboards.css?v=2.0.1" rel="stylesheet" />

</head>

<body class="body">

    <div class="header" >

      <!-- Navbar -->
      <div class="Navbar">
        <ul class="topnav">

          <div class="tavba">
            <li class="navbar-user">
              <a href="singout.php"  style="color:black;"><i class="fa fa-power-off"></i>.Out</a>
            </li>
            <li class="navbar-singin">
                <a href="singup.php"  style="color:black;"><i class="fa fa-user "></i> <?php echo $_SESSION['username']; ?> </a>
            </li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="video.php">ビデオ</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">ニュース</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="hoadon.php">明細書</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="hoadonnhanvien.php">従業員の離職率</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="visa.php">ビザ申請</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="khachhang.php">顧客情報</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a class="active" style="color:black"    href="taikhoankhachhang.php">顧客口座</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="nhanvien.php">従業員アカウント</a></li>





          </div>
       </ul>
      </div>
      <!--END Navbar-->

    </div>

    <div class="section" style="margin: 20px;overflow:hidden">
      <div class="container-fuid">
        <div class="section-txt">
          <h1 >DANH SÁCH KHÁCH HÀNG</h1>
        </div>
        <div class="row" style="margin-top:20px;margin-bottom:10px;">


            <form  class="timkiem" method="post" >
                      <div class="" style=" margin-top: 10px;position: relative;right:-280px;top:-10px;" >
                            <div class="row">
                                <div class="col-sm-2">
                                   <label>Nhân viên</label>
                                   <input type="text" class="" name="nv" list="nvv"  placeholder="nhân viên" style="width: 150px;"/>
                                   <?php $addnv=$get_data->select_nhanvien();?>
                                    <datalist id="nvv">
                                      <?php foreach($addnv as $seaddnv){?>
                                        <option value="<?php echo $seaddnv['NVID'];?>"><?php echo $seaddnv['NAMENV']; ?></option>
                                      <?php } ?>
                                    </datalist>
                                </div>
                                <div class="col-sm-2">
                                   <label>Khách hàng</label>
                                   <input type="text" class="" name="name" list="khv"  placeholder="khách hàng" style="width: 150px;"/>
                                   <?php $addkh=$get_data->select_khachhang();?>
                                    <datalist id="khv">
                                      <?php foreach($addkh as $seaddkh){?>
                                        <option value="<?php echo $seaddkh['KHID']; ?>"><?php echo $seaddkh['NAMEKH']; ?></option>
                                      <?php } ?>
                                    </datalist>
                                </div>
                                <div class="col-sm-2">
                                  <label>Từ ngày</label>
                                  <input name="tu" type="date" class=""   style="width: 150px;">
                                </div>
                                <div class="col-sm-2">
                                  <label>Đến ngày</label>
                                  <input name="den" type="date" class=""   style="width: 150px;">
                                </div>
                                <div class="col-sm-2">
                                     <input type="submit" class="" name="timkiem" value="search" style="width: 100px;height: 50px;position: relative;left: 50px; top:31px;" />
                                </div>
                            </div>
                        </div>
            </form>
        </div>





        <div class="content">
          <div class="row">
<?php

   $trangthaiviec=$get_data->count_trangthaiviec();
   foreach($trangthaiviec as $ttv){}

 ?>

            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-5 col-md-4">
                      <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-single-02 text-warning"></i>
                      </div>
                    </div>
                    <div class="col-7 col-md-8">
                      <div class="numbers">
                        <p class="card-category">Chưa đi phỏng vấn</p>
                        <p class="card-title"><?php echo $ttv['chuapv']  ?>/<?php echo $ttv['tong'] ?><p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer ">
                    <hr>
                    <div class="stats">
                      <?php   if(isset($_POST["timkiem1"])){
                           $tk=$get_data->search_trangthaichuapv();
                      } ?>
                      <i class="fa fa-refresh"></i>
                        <form method="post" >
                           <input class="form-control" type="submit" name="timkiem1" value="hiển thị">
                        </from>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-5 col-md-4">
                      <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-time-alarm text-success"></i>
                      </div>
                    </div>
                    <div class="col-7 col-md-8">
                      <div class="numbers">
                        <p class="card-category">Đang chờ kết quả</p>
                        <p class="card-title"><?php echo $ttv['chokq']  ?>/<?php echo $ttv['tong'] ?><p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer ">
                    <hr>
                    <div class="stats">
                      <?php   if(isset($_POST["timkiem2"])){
                           $tk=$get_data->search_trangthaidoikq();
                      } ?>
                      <i class="fa fa-refresh"></i>
                        <form method="post" >
                           <input class="form-control" type="submit" name="timkiem2" value="hiển thị">
                        </from>
                    </div>
                  </div>
                </div>

              </div>
            </div>



            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-5 col-md-4">
                      <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-check-2 text-danger"></i>
                      </div>
                    </div>
                    <div class="col-7 col-md-8">
                      <div class="numbers">
                        <p class="card-category">Đã chúng tuyển</p>
                        <p class="card-title"><?php echo $ttv['chungtuyen']  ?>/<?php echo $ttv['tong'] ?><p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer ">
                    <hr>
                    <div class="stats">
                      <?php   if(isset($_POST["timkiem3"])){
                           $tk=$get_data->search_trangthaithanhcong();
                      } ?>
                      <i class="fa fa-refresh"></i>
                        <form method="post" >
                           <input class="form-control" type="submit" name="timkiem3" value="hiển thị">
                        </from>
                    </div>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-5 col-md-4">
                      <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-simple-remove text-primary"></i>
                      </div>
                    </div>
                    <div class="col-7 col-md-8">
                      <div class="numbers">
                        <p class="card-category">Hủy yêu cầu</p>
                        <p class="card-title"><?php echo $ttv['huyyc']  ?>/<?php echo $ttv['tong'] ?><p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer ">
                    <hr>
                    <div class="stats">
                      <?php   if(isset($_POST["timkiem4"])){
                        $tk=$get_data->search_trangthaihuy();
                      } ?>
                      <i class="fa fa-refresh"></i>
                        <form method="post" >
                           <input class="form-control" type="submit" name="timkiem4" value="hiển thị">
                        </from>
                    </div>
                  </div>
                </div>

              </div>
            </div>



          </div>
    </div>

    <?php   if(isset($_POST["timkiem4"])){
      $tk=$get_data->search_hoso($_POST['tu'], $_POST['den'],$_POST['name'],$_POST['nv']);
    } ?>
        <form  class="hienthi" role="form" method="post" enctype="multipart/form-data"style="overflow:auto;max-height: 500px;">
         <table class="table table-bordered table-striped table-responsive-stack"   id="tableOne">
           <?php
                 $stt=1;
                 if ($tk!="") { ?>

                 <thead>
                   <tr>
                     <th>STT</th>
                     <th>Khách hàng id</th>
                     <th>tên nhân viên 1</th>
                     <th>tên nhân viên 2</th>
                     <th>giới tính</th>
                     <th>bằng cấp</th>
                     <th>năng lực tiếng nhật</th>
                     <th>Hạn visa</th>
                     <th>Nguyện vong</th>
                     <th>sdt</th>
                     <th>email</th>
                     <th>Công ty xin </th>
                     <th>Trạng thái việc làm</th>
                     <th >Hợp đồng BDF</th>
                   </tr>
               </thead>
               <tbody>
                   <?php

                   // if($tk2!=null||$tk2!=""){
                   //   $tk=$tk2;
                   // }
                   // else {
                   //
                   // }

                   $stt=0;

                   foreach($tk as $se){ ?>
                     <tr style="<?php if ($se['trangthaiviec']=="chưa phỏng vấn") {
                               echo "";
                          }else if($se['trangthaiviec']=="đang chờ kết quả") {
                               echo "background-color:#528B8B;color:black;";
                          }else if($se['trangthaiviec']=="đã chúng tuyển") {
                                echo "background-color:#EEAD0E;color:black;";
                          }else if($se['trangthaiviec']=="hủy yêu cầu") {
                                echo "background-color:gray;color:white;";
                     } ?>">

                       <td><?php echo $stt ?></td>
                       <td>
                         <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['KHID'];?></h1>
                         <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMEKH'] ?>)</h2>
                       </td>

                       <td>
                         <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NVID'];?></h1>
                         <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMENV'] ?>)</h2>
                       </td>
                       <td>
                         <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NV2ID'];?></h1>
                         <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMENV2'] ?>)</h2>
                       </td>
                       <td><?php echo $se['gioitinh'] ?></td>
                       <td><?php echo $se['bangcap'] ?></td>
                       <td><?php echo $se['nangluc'] ?></td>
                       <td><?php echo $se['NGAYHET'] ?></td>
                       <td><?php echo $se['nguyenvong'] ?></td>
                       <td><?php echo $se['PHONEKH'] ?></td>
                       <td><?php echo $se['EMAIL'] ?></td>
                       <td><?php echo $se['CONGTYXIN'] ?></td>
                       <td><?php echo $se['trangthaiviec'] ?></td>
                       <td ><a style="color:red;max-width:20px;" href="readfile.php?read=<?php echo $se['VISAID']; ?>" target="_blank"><?php  echo $se['name_file'];  ?></a></td>
                     </tr>
                       </tbody>


                   <?php $stt++;} ?>
                   <!-- </c:forEach> -->
             <?php }   else {  $stt=0; ?>
                   <thead>
                   <tr>

                     <th>STT</th>
                     <th>Khách hàng id</th>
                     <th>tên nhân viên 1</th>
                     <th>tên nhân viên 2</th>
                     <th>giới tính</th>
                     <th>bằng cấp</th>
                     <th>năng lực tiếng nhật</th>
                     <th>Hạn visa</th>
                     <th>Nguyện vong</th>
                     <th>sdt</th>
                     <th>email</th>
                     <th>Công ty xin </th>
                     <th>Trạng thái việc làm</th>
                     <th >Hợp đồng BDF</th>

                   </tr>
               </thead>
               <tbody>

               <?php

               foreach( $result as $se){ ?>
                 <tr style="<?php if ($se['trangthaiviec']=="chưa phỏng vấn") {
                           echo "";
                      }else if($se['trangthaiviec']=="đang chờ kết quả") {
                           echo "background-color:#528B8B;color:black;";
                      }else if($se['trangthaiviec']=="đã chúng tuyển") {
                            echo "background-color:#EEAD0E;color:black;";
                      }else if($se['trangthaiviec']=="hủy yêu cầu") {
                            echo "background-color:gray;color:white;";
                 } ?>">

                     <td><?php echo $stt ?></td>
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['KHID'];?></h1>
                       <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMEKH'] ?>)</h2>
                     </td>

                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NVID'];?></h1>
                       <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMENV'] ?>)</h2>
                     </td>
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NV2ID'];?></h1>
                       <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMENV2'] ?>)</h2>
                     </td>
                     <td><?php echo $se['gioitinh'] ?></td>
                     <td><?php echo $se['bangcap'] ?></td>
                     <td><?php echo $se['nangluc'] ?></td>
                     <td><?php echo $se['NGAYHET'] ?></td>
                     <td><?php echo $se['nguyenvong'] ?></td>
                     <td><?php echo $se['PHONEKH'] ?></td>
                     <td><?php echo $se['EMAIL'] ?></td>
                     <td><?php echo $se['CONGTYXIN'] ?></td>
                     <td><?php echo $se['trangthaiviec'] ?></td>
                     <td ><a style="color:red;max-width:20px;" href="readfile.php?read=<?php echo $se['VISAID']; ?>" target="_blank"><?php  echo $se['name_file'];  ?></a></td>
                   </tr>
                   </tbody>
               <?php $stt++;} ?>

             <?php } ?>



         </table>
        </form>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
             // PHẦN HIỂN THỊ PHÂN TRANG
             // BƯỚC 7: HIỂN THỊ PHÂN TRANG
             // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
             if ($current_page > 1 && $total_page > 1){
                     echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="visa.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
             }
             // Lặp khoảng giữa
             for ($i = 1; $i <= $total_page; $i++){
                 // Nếu là trang hiện tại thì hiển thị thẻ span
                 // ngược lại hiển thị thẻ a
                 if ($i == $current_page){
                     echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
                 }
                 else{
                     echo ' <li class="page-item"><a class="page-link" href="visa.php?page='.$i.'">'.$i.'</a></li> ';
                 }
             }
             // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
             if ($current_page < $total_page && $total_page > 1){
                    echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="visa
                    .php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
             }
            ?>
      </ul>
    </nav>



      </div>
    </div>








    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
