

<?php
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt=$get_data->list_nhanvien($ID);

$del=$_GET['del'];
$dk = $get_data->delete_user_nhanvien($del);
$dk = $get_data->delete_nhanvien($del);

foreach($slt as $selist){}

  $result = mysqli_query($conn, 'select count(NVID) as total from nhanvien');
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
  $result = mysqli_query($conn, "SELECT * FROM users INNER JOIN nhanvien ON users.USERID=nhanvien.USERID LIMIT $start, $limit");
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> スタッフ </title>
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


  <?php
  $selectmax=$get_data->max_uid();//gọi đến function.
  foreach($selectmax as $semax)
  {}

    $maxid=$get_data->max_nhanvien_id();
    foreach($maxid as $mid){}
    $mid=(int)$mid['max'];

    if($mid < 9){
      $mid=$mid+1;
      $id='0000'.(string)$mid;
    }
    else if($mid < 99){
      $mid=$mid+1;
      $id='000'.(string)$mid;
    }
    else if($mid < 999){
      $mid=$mid+1;
      $id='00'.(string)$mid;
    }
    else if($mid < 9999){
      $mid=$mid+1;
      $id='0'.(string)$mid;
    }
    else if($mid < 99999){
      $mid=$mid+1;
      $id=''.(string)$mid;
    }


  if(isset($_POST['add'])){
    $PHANQUYEN=1;
    if ($_POST['password']!=$_POST['repass']) {
      $message = "Password nhập lại không đúng";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else {
            $dk = $get_data->dangky($semax['max'],$_POST['username'], $_POST['password'],$PHANQUYEN);
            $dkk = $get_data->insert_nhanvien($_POST['idnv'],$_POST['tennhanvien'],$_POST['sodienthoai'],$_POST['email'],$_POST['diachi'],$semax['max'],$_POST['congty']);

            if (!isset($dkk)) {
              $dk = $get_data->delete_tk($_POST['username']);
            }
            if (!isset($dk)) {
              $dk = $get_data->delete_nhanvien($_POST['idnv']);
            }

            if($dkk and $dk){header("Location:nhanvien.php");}

}
  }

  if(isset($_POST['edit'])){
         $dkk1= $get_data->nvid_update_hoadon($_POST['idnv'],$_POST['id']);
         $dkk2= $get_data->nvid_update_visa($_POST['idnv'],$_POST['id']);
         $dkk5= $get_data->nvid_update_visa2($_POST['idnv'],$_POST['id']);

         $dkk3= $get_data->nvid_update_visanv1($_POST['idnv'],$_POST['id']);
         $dkk4= $get_data->nvid_update_visanv2($_POST['idnv'],$_POST['id']);

         $dkk = $get_data->update_nhanvien($_POST['tennhanvien'],$_POST['sodienthoai'],$_POST['email'],$_POST['diachi'],$_POST['idnv'],$_POST['congty'],$_POST['id']);

         if($dkk){header("Location:nhanvien.php");}
  }
   ?>
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
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="video.php">ビデオ</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">ニュース</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="hoadon.php">明細書</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="hoadonnhanvien.php">従業員の離職率</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="visa.php">ビザ申請</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="khachhang.php">顧客情報</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a      href="taikhoankhachhang.php">顧客口座</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a class="active" style="color:black"  href="nhanvien.php">従業員アカウント</a></li>



          </div>
       </ul>
      </div>
      <!--END Navbar-->

    </div>

    <div class="section">
      <div class="container">
        <div class="section-txt">
          <h1 > スタッフ</h1>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="btn-add">
              <?php if($ID!=NULL){echo '<button type="button" class="btn" data-toggle="modal" style="background-color:black;color:white;" data-target="#myModaleadd">  EDIT スタッフ </button> <button type="button" class="btn" hea> <a href="nhanvien.php">BACK</a> </button> '; } else{echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModaleadd">ADD NEW</button>';} ?>
            </div>




          </div>

          <!-- <div class="col-md-4">
            <form class="timkiem" method="post">
                <input type="text"  name="search"  placeholder="Tìm kiếm" />
                <input type="submit" name="timkiem" value="search" />
            </form>
          </div> -->
        </div>

        <form  class="hienthi" role="form" method="post" enctype="multipart/form-data"style="overflow:auto;">
         <table class="table table-bordered table-striped table-responsive-stack"  id="tableOne">
            <tr>
              <th></th>
              <th>No</th>
              <th> スタッフID</th>
              <th>名前</th>
              <th>電話番号</th>
              <th>メール</th>
              <th>住所</th>
              <th>CONGTY</th>
              <th>アカウント</th>
              <th>Password</th>
           </tr>
           <?php
           $stt=1;
           if (isset($_POST['timkiem'])) {
             $tk=$get_data->search_nhanvien($_POST['search']);

           ?>

             <?php $stt=0; foreach($tk as $se){ ?>
                 <tr>
                   <td  style="width:200px;" align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                     <div class="row" style="margin:5px;">
                       <div style="margin-bottom:10px;" class="btn-edit"><a href="nhanvien.php?edit=<?php echo $se['NVID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                       <div style=";" class="btn-del"><a href="nhanvien.php?del=<?php echo $se['NVID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                     </div>
                   </td>
                     <td><?php echo $stt ?></td>
                     <td><?php echo $se['NVID'] ?></td>
                     <td><?php echo $se['NAMENV'] ?></td>
                     <td><?php echo $se['PHONE'] ?></td>
                     <td><?php echo $se['EMAIL'] ?></td>
                     <td><?php echo $se['DIACHI'] ?></td>
                     <td><?php echo $se['NVCONGTY'] ?></td>
                     <td><?php echo $se['NAME'] ?></td>
                     <td><?php echo $se['PASS'] ?></td>



                 </tr>
             <?php $stt++;} ?>
             <!-- </c:forEach> -->


       <?php }   else { ?>
         <?php $stt=0; foreach($result as $se){ ?>
             <tr>
               <td  style="width:200px;" align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                 <div class="row" style="margin:5px;">
                   <div style="margin-bottom:10px;" class="btn-edit"><a href="nhanvien.php?edit=<?php echo $se['NVID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                   <div style=";" class="btn-del"><a href="nhanvien.php?del=<?php echo $se['NVID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                 </div>
               </td>
               <td><?php echo $stt ?></td>
               <td><?php echo $se['NVID'] ?></td>
               <td><?php echo $se['NAMENV'] ?></td>
               <td><?php echo $se['PHONE'] ?></td>
               <td><?php echo $se['EMAIL'] ?></td>
               <td><?php echo $se['DIACHI'] ?></td>
               <td><?php echo $se['NVCONGTY'] ?></td>
               <td><?php echo $se['NAME'] ?></td>
               <td><?php echo $se['PASS'] ?></td>

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
                     echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="nhanvien.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
             }
             // Lặp khoảng giữa
             for ($i = 1; $i <= $total_page; $i++){
                 // Nếu là trang hiện tại thì hiển thị thẻ span
                 // ngược lại hiển thị thẻ a
                 if ($i == $current_page){
                     echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
                 }
                 else{
                     echo ' <li class="page-item"><a class="page-link" href="nhanvien.php?page='.$i.'">'.$i.'</a></li> ';
                 }
             }
             // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
             if ($current_page < $total_page && $total_page > 1){
                    echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="nhanvien.php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
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



             <form action=""  method="post" style="padding-left: 90px;padding-right: 90px;" >
               <input type="hidden" name="id" value="<?php if($ID!=NULL){echo $selist['ID']; } else{echo '';} ?>">
               <div class="form-group">
                   <div class="row">
                       <div class="col-sm-4">
                          <label>アカウント</label>
                          <input name="username" type="text" value="" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?> class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>  required  >
                       </div>
                       <div class="col-sm-4">
                           <label>Password</label>
                           <input name="password" type="password" value="" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>  required  >
                       </div>
                       <div class="col-sm-4">
                           <label>confirmPassword</label>
                           <input name="repass" type="password" value="" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>  required  >
                       </div>
                   </div>
               </div>
                     <div class="form-group">
                         <div class="row">
                           <div class="col-sm-6">
                               <label> スタッフID</label>
                               <input name="idnv" type="text" value="<?php if($ID!=NULL){echo $selist['NVID']; } else{echo $id;} ?>" class="form-control"  required  >
                           </div>
                             <div class="col-sm-6">
                                 <label>名前</label>
                                 <input name="tennhanvien" type="text" value="<?php if($ID!=NULL){echo $selist['NAMENV']; } else{echo '';} ?>" class="form-control"  required  >
                             </div>
                         </div>
                     </div>

                     <div class="form-group">
                       <label>住所</label>
                       <textarea name="diachi" class="form-control" required style="height: 100px;"><?php if($ID!=NULL){echo $selist['DIACHI']; } else{echo '';} ?></textarea>
                     </div>

                      <div class="form-group">
                         <div class="row">
                              <div class="col-sm-6">
                                 <label>メール</label>
                                 <input name="email" type="email" value="<?php if($ID!=NULL){echo $selist['EMAIL']; } else{echo '';} ?>" class="form-control"  required  >
                             </div>
                             <div class="col-sm-6">
                               <label>電話番号</label>
                                <input name="sodienthoai" type="text" value="<?php if($ID!=NULL){echo $selist['PHONE']; } else{echo '';} ?>" class="form-control"  required  >
                            </div>
                        </div>
                      </div>

                      <div class="form-group">
                         <div class="row">
                             <div class="col-sm-12">
                               <label>会社員</label>
                                <input name="congty" type="text" value="<?php if($ID!=NULL){echo $selist['PHONE']; } else{echo '';} ?>" class="form-control"  required  >
                            </div>
                        </div>
                      </div>



                     <div class="form-group btn-submit-add" style="padding-left: 100px;margin-top:20px;">
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
