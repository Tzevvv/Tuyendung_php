<?php
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt=$get_data->list_lawyer($ID);

$del=$_GET['del'];
$dk = $get_data->delete($del);

foreach($slt as $selist){}

  //BƯỚC 1: KẾT NỐI SQL
  // BƯỚC 2: TÌM TỔNG SỐ RECORDS
  $result = mysqli_query($conn, 'select count(LSID) as total from luatsu');
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
  $result = mysqli_query($conn, "SELECT * FROM luatsu LIMIT $start, $limit");
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
    <link href="css\csss2.css" rel="stylesheet">
</head>

<body class="body">


  <?php
  $maxid=$get_data->max_luatsu_id();
  foreach($maxid as $mid){}
  $mid=(int)$mid['max'];

  if($mid < 9){
    $mid=$mid+1;
    $id='LS0000'.(string)$mid;
  }
  else if($mid < 99){
    $mid=$mid+1;
    $id='LS000'.(string)$mid;
  }
  else if($mid < 999){
    $mid=$mid+1;
    $id='LS00'.(string)$mid;
  }
  else if($mid < 9999){
    $mid=$mid+1;
    $id='LS0'.(string)$mid;
  }
  else if($mid < 99999){
    $mid=$mid+1;
    $id='LS'.(string)$mid;
  }

  if(isset($_POST['add'])){
    $dk = $get_data->insert_lawyer($_POST['maluatsu'], $_POST['tenluatsu'],$_POST['sdt'],$_POST['email'] );
     if($dk){header("Location:luatsu.php");}

  }
  if(isset($_POST['edit'])){
    $dk = $get_data->update_lawyer($_POST['maluatsu'],$_POST['tenluatsu'],$_POST['sdt'],$_POST['email']);
    if($dk){header("Location:luatsu.php");}
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
                <a href="singup.php"><i class="fa fa-user "></i> <?php echo $_SESSION['username']; ?> </a>
            </li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="hoadon.php">Hoadon</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="hoadonnhanvien.php">Doanh thu nv</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a href="hoadonkhachhang.php">Danh sách khách</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="visa.php">Hồ sơ</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">Tintuc</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a class="active" href="luatsu.php">Luatsu</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="taikhoankhachhang.php">Khachhang</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="nhanvien.php">Nhanvien</a></li>
          </div>
       </ul>
      </div>
      <!--END Navbar-->

    </div>

    <div class="section">
      <div class="container">
        <div class="section-txt">
          <h1 >LUẬT SƯ</h1>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="btn-add">
              <?php if($ID!=NULL){echo '<button type="button" class="btn" data-toggle="modal" style="background-color:black;color:white;" data-target="#myModaleadd">  EDIT KHÁCH HÀNG   </button> <button type="button" class="btn" hea> <a href="luatsu.php">BACK</a> </button> '; } else{echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModaleadd">ADD NEW</button>';} ?>
            </div>




          </div>


        </div>

        <form  class="hienthi" role="form" method="post" enctype="multipart/form-data">
         <table class="table table-bordered table-striped table-responsive-stack"  id="tableOne">
            <tr>
              <th >  </th>
              <th>STT</th>
              <th>Mã luật sư</th>
              <th>Tên luật sư</th>
              <th>Số điện thoại</th>
              <th>email</th>
              <th >  </th>
           </tr>
           <?php
           $stt=1;
           if (isset($_POST['timkiem'])) {
              $tk=$get_data->search_lawyer($_POST['search']);

           ?>

             <?php $stt=0; foreach($tk as $se){ ?>
                 <tr>
                     <td></td>
                     <td><?php echo $stt ?></td>
                     <td><?php echo $se['LSID'] ?></td>
                     <td><?php echo $se['NAME'] ?></td>
                     <td><?php echo $se['PHONE'] ?></td>
                     <td><?php echo $se['EMAIL'] ?></td>
                     <td align="center">
                         <div class="row">
                           <div class="btn-edit"><a href="luatsu.php?edit=<?php echo $se['LSID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                           <div class="btn-del"><a href="luatsu.php?del=<?php echo $se['LSID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                         </div>
                     </td>
                 </tr>
             <?php $stt++;} ?>
             <!-- </c:forEach> -->


       <?php }   else { ?>
         <?php $stt=0; foreach($result as $se){ ?>
             <tr>
               <td></td>
               <td><?php echo $stt ?></td>
               <td><?php echo $se['LSID'] ?></td>
               <td><?php echo $se['NAME'] ?></td>
               <td><?php echo $se['PHONE'] ?></td>
               <td><?php echo $se['EMAIL'] ?></td>
               <td align="center">
                   <div class="row">
                     <div class="btn-edit"><a href="luatsu.php?edit=<?php echo $se['LSID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                     <div class="btn-del"><a href="luatsu.php?del=<?php echo $se['LSID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
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
                     echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="luatsu.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
             }
             // Lặp khoảng giữa
             for ($i = 1; $i <= $total_page; $i++){
                 // Nếu là trang hiện tại thì hiển thị thẻ span
                 // ngược lại hiển thị thẻ a
                 if ($i == $current_page){
                     echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
                 }
                 else{
                     echo ' <li class="page-item"><a class="page-link" href="luatsu.php?page='.$i.'">'.$i.'</a></li> ';
                 }
             }
             // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
             if ($current_page < $total_page && $total_page > 1){
                    echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="luatsu.php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
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
              <h2 style="position:relative; right:200px;">LUATSU ADD</h2>
            </div>
          </div>

          <div class="modal-body">



             <form action=""  method="post" style="padding-left: 90px;padding-right: 90px;" >

                     <div class="form-group">
                                 <label>Mã luật sư</label>
                                 <input name="maluatsu" type="text" value="<?php if($ID!=NULL){echo $selist['LSID']; } else{echo $id;} ?>" class="form-control" readonly  required  >
                     </div>
                     <div class="form-group">
                                 <label>Tên luật sư</label>
                                 <input name="tenluatsu" type="text" value="<?php if($ID!=NULL){echo $selist['NAME']; } else{echo '';} ?>" class="form-control"  required  >
                     </div>
                     <div class="form-group">
                                 <label>Số điện thoại</label>
                                 <input name="sdt" type="text" value="<?php if($ID!=NULL){echo $selist['PHONE']; } else{echo '';} ?>" class="FORM-control"  required  >
                     </div>
                     <div class="form-group">
                                 <label>Email</label>
                                 <input name="email" type="text" value="<?php if($ID!=NULL){echo $selist['EMAIL']; } else{echo '';} ?>" class="form-control"  required  >
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
