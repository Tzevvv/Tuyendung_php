
<?php
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt=$get_data->list_khachhang($ID);

$del=$_GET['del'];
$dk = $get_data->delete_khachhang($del);
$dk = $get_data->delete_user($del);

foreach($slt as $selist){}

//BƯỚC 1: KẾT NỐI SQL
// BƯỚC 2: TÌM TỔNG SỐ RECORDS
$result = mysqli_query($conn, 'select count(KHID) as total from khachhang');
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
$result = mysqli_query($conn, "SELECT * FROM khachhang  INNER JOIN users ON users.USERID=khachhang.USERID  LIMIT $start, $limit");
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
</head>

<body class="body">
  <script src="content/bootstrapJS/jquery-2.1.1.min.js" type="text/javascript"></script>

  <script type="text/javascript">
      $(window).load(function(){
        $('#myModaleadd').modal('show');
      });
  </script>

  <?php if (isset($_POST['add'])) {

  }  ?>
    <div class="header">

      <!-- Navbar -->
      <div class="Navbar">
        <ul class="topnav">

          <div class="tavba">
            <li class="navbar-user">
              <a href="singout.php"><i class="fa fa-power-off"></i>.Out</a>
            </li>
            <li class="navbar-singin">
                <a href=""><i class="fa fa-user "></i> <?php echo $_SESSION['username']; ?> </a>
            </li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="video.php">video</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">Tintuc</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="hoadon.php">Hoadon</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a class="active" style="color:black"  href="hoadonnhanvien.php">Doanh thu nv</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="visa.php">hồ sơ visa</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="khachhang.php">hồ sơ khách hàng</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="taikhoankhachhang.php">Tài khoản khách</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="nhanvien.php">Tài khoản nhanvien</a></li>



          </div>
       </ul>
      </div>
      <!--END Navbar-->

    </div>

    <div class="section">
      <div class="container">
        <div class="section-txt">
          <h1 >KHACH HÀNG</h1>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="btn-add">
              <?php if($ID!=NULL){echo '<button type="button" class="btn" data-toggle="modal" style="background-color:black;color:white;" data-target="#myModaleadd">  EDIT KHÁCH HÀNG   </button> <button type="button" class="btn" hea> <a href="khachhang.php">BACK</a> </button> '; } else{echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModaleadd">ADD NEW</button>';} ?>
            </div>




          </div>

          <div class="col-md-4">
            <form class="timkiem" method="post">
                <input type="text"  name="search"  placeholder="Tìm kiếm" />
                <input type="submit" name="timkiem" value="search" />
            </form>
          </div>
        </div>

        <form  class="hienthi" role="form" method="post" enctype="multipart/form-data">
         <table class="table table-bordered table-striped table-responsive-stack"  id="tableOne">
            <tr>
              <th>STT</th>
              <th>KHID</th>
              <th>NAMEKH</th>
              <th>PHONEKH</th>
              <th>EMAIL</th>
              <th>DIACHI</th>
              <th>TAIKHOAN</th>
              <th>MATKHAU</th>
              <th >  </th>
           </tr>
           <?php
           $stt=1;
           if (isset($_POST['timkiem'])) {
             if (empty($_POST['search'])) {
               $message = "Vui lòng nhập khi tìm kiếm";
               $txtthongbao=$message;
             }
             $tk=$get_data->search_khachhang($_POST['search']);

           ?>
             <?php $stt=0; foreach($tk as $se){ ?>
                 <tr>
                     <td><?php echo $stt ?></td>
                     <td><?php echo $se['KHID'] ?></td>
                     <td><?php echo $se['NAMEKH'] ?></td>
                     <td><?php echo $se['PHONEKH'] ?></td>
                     <td><?php echo $se['EMAIL'] ?></td>
                     <td><?php echo $se['DIACHI'] ?></td>
                     <td><?php echo $se['NAME'] ?></td>
                     <td><?php echo $se['PASS'] ?></td>
                     <td align="center">
                         <div class="row">
                           <div class="btn-edit"><a href="khachhang.php?edit=<?php echo $se['KHID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                           <div class="btn-del"><a href="khachhang.php?del=<?php echo $se['USERID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                         </div>
                     </td>
                 </tr>
             <?php $stt++;} ?>
             <!-- </c:forEach> -->


       <?php }   else { ?>
         <?php $stt=0; foreach($result as $se){ ?>
             <tr>
                 <td><?php echo $stt ?></td>
                 <td><?php echo $se['KHID'] ?></td>
                 <td><?php echo $se['NAMEKH'] ?></td>
                 <td><?php echo $se['PHONEKH'] ?></td>
                 <td><?php echo $se['EMAIL'] ?></td>
                 <td><?php echo $se['DIACHI'] ?></td>
                 <td><?php echo $se['NAME'] ?></td>
                 <td><?php echo $se['PASS'] ?></td>
                 <td align="center">
                     <div class="row">
                       <div class="btn-edit"><a href="khachhang.php?edit=<?php echo $se['KHID'];?> " data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                       <div class="btn-del"><a href="khachhang.php?del=<?php echo $se['USERID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                     </div>
                 </td>
             </tr>
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
                 echo '<li class="page-item btn-item"> <a class="page-link" href="khachhang.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
         }
         // Lặp khoảng giữa
         for ($i = 1; $i <= $total_page; $i++){
             // Nếu là trang hiện tại thì hiển thị thẻ span
             // ngược lại hiển thị thẻ a
             if ($i == $current_page){
                 echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
             }
             else{
                 echo ' <li class="page-item"><a class="page-link" href="khachhang.php?page='.$i.'">'.$i.'</a></li> ';
             }
         }
         // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
         if ($current_page < $total_page && $total_page > 1){
                echo ' <li class="page-item btn-item"><a class="page-link" href="khachhang.php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
         }
        ?>
      </ul>
    </nav>



      </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModaleadd" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="section-txt" align=center>
              <h2 style="position:relative; right:200px;">FEATURES ADD</h2>
            </div>
          </div>

          <div class="modal-body">
            <?php

            $selectmax=$get_data->max_uid();//gọi đến function.
            foreach($selectmax as $semax)
            {}
            if(isset($_POST['add'])){
              $PHANQUYEN=2;
              if ($_POST['password']!=$_POST['repass']) {
                $message = "Password nhập lại không đúng";
                echo "<script type='text/javascript'>alert('$message');</script>";
              }
              else {
                $dk = $get_data->dangky($semax['max'],$_POST['username'], $_POST['password'],$PHANQUYEN);
                $dk = $get_data->insert_khachhang($_POST['hoten'], $_POST['phone'], $_POST['email'], $_POST['diachi'],$semax['max']);

              }
            }
             ?>
             <?php
             $selectmax=$get_data->max_uid();//gọi đến function.
             foreach($selectmax as $semax)
             {}
             if(isset($_POST['add'])){
                  $PHANQUYEN=2;
                  if ($_POST['password']!=$_POST['repass']) {
                     $message = "Password nhập lại không đúng";
                     echo "<script type='text/javascript'>alert('$message');</script>";
                  }
                  else {
                     $dk = $get_data->dangky($semax['max'],$_POST['username'], $_POST['password'],$PHANQUYEN);
                     $dk = $get_data->insert_khachhang($_POST['hoten'], $_POST['phone'], $_POST['email'], $_POST['diachi'],$semax['max']);
                   }
             }
             if(isset($_POST['edit'])){
                    $dk = $get_data->update_khachhang($_POST['hoten'], $_POST['diachi'], $_POST['email'], $_POST['phone'], $_POST['username']);
             }
              ?>

                       <form action=""  method="post" style="padding-left: 90px;padding-right: 90px;" >

                         <div class="form-group">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <label><?php if($ID!=NULL){echo 'MÃ KHÁCH HÀNG'; } else{echo 'TÀI KHOẢN';} ?></label>
                                     <input name="username" type="text" value="<?php if($ID!=NULL){echo $selist['KHID'];; } else{echo '';} ?>" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>  required  >
                                 </div>
                                 <div class="col-sm-4">
                                     <label>MATKHAU</label>
                                     <input name="password" type="password" value="" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>  required  >
                                 </div>
                                 <div class="col-sm-4">
                                     <label>NHAPLAIMATKHAU</label>
                                     <input name="repass" type="password" value="" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>   required  >
                                 </div>
                             </div>
                         </div>

                               <div class="form-group">
                                   <div class="row">

                                       <div class="col-sm-12">
                                           <label>TÊN KHÁCH HÀNG</label>
                                           <input name="hoten" type="text" value="<?php if($ID!=NULL){echo $selist['NAMEKH']; } else{echo '';} ?>" class="form-control"  required  >
                                       </div>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label>Địa chỉ</label>
                                   <textarea name="diachi" class="form-control" required style="height: 100px;"><?php if($ID!=NULL){echo $selist['DIACHI']; } else{echo '';} ?></textarea>
                               </div>
                                <div class="form-group">
                                   <div class="row">
                                        <div class="col-sm-6">
                                           <label>Email</label>
                                           <input name="email" type="email" value="<?php if($ID!=NULL){echo $selist['EMAIL']; } else{echo '';} ?>" class="form-control"  required  >
                                       </div>
                                       <div class="col-sm-6">
                                           <label>Số điện thoại</label>
                                           <input name="phone" type="text" value="<?php if($ID!=NULL){echo $selist['PHONEKH']; } else{echo '';} ?>" class="form-control"  required  >
                                       </div>
                                   </div>
                               </div>

                               <div class="form-group btn-submit-add" style="padding-left: 100px; ">
                                  <input type="submit" name="<?php if($ID!=NULL){echo 'edit'; } else{echo 'add';} ?>" class="btn " value="SUBMIT" >
                               </div>
                       </form>



          </div>
        </div>
      </div>
      <!-- End Modal -->




    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
