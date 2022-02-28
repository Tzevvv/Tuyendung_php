

<?php
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt=$get_data->list_hoadon($ID);

$del=$_GET['del'];
$dk = $get_data->delete_hoadon($del);







foreach($slt as $selist){}



  //BƯỚC 1: KẾT NỐI SQL
  // BƯỚC 2: TÌM TỔNG SỐ RECORDS
  $result = mysqli_query($conn, 'select count(idhoadon) as total from hoadon');
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
  $result = mysqli_query($conn, "SELECT * FROM users INNER JOIN nhanvien ON users.USERID=nhanvien.USERID  LIMIT $start, $limit");
   ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>明細書  </title>
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
    <link href="assets/css/paper-dashboards.css?v=2.0.1" rel="stylesheet" />
</head>
<body class="body">


    <div class="header">

      <!-- Navbar -->
      <div class="Navbar">
        <ul class="topnav">

          <div class="tavba">
            <li class="navbar-user" style="color:black">
              <a href="singout.php" style="color:black"><i class="fa fa-power-off"></i>.Out</a>
            </li>
            <li class="navbar-singin" style="color:black">
                <a href="" style="color:black"><i class="fa fa-user "></i> <?php echo $_SESSION['username']; ?> </a>
            </li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="video.php">ビデオ</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">ニュース</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="hoadon.php">明細書</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a class="active" style="color:black"  href="hoadonnhanvien.php">従業員の離職率</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="visa.php">ビザ申請</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="khachhang.php">顧客情報</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="taikhoankhachhang.php">顧客口座</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="nhanvien.php">従業員アカウント</a></li>





          </div>
       </ul>
      </div>
      <!--END Navbar-->

    </div>

    <div class="section" style="margin: 20px;overflow:hidden">
      <div class="container-fuid">
        <div class="section-txt">
          <h1 >従業員の離職率</h1>
        </div>
        <div class="row">
          <div class="col-md-1">
          </div>


          <form  class="timkiem" method="post" >
                    <div class="" style="margin-bottom: 20px; position: relative;right:-250px;" >
                          <div class="row">
                              <div class="col-sm-3">
                                <label>名前</label>
                                <input type="text" class="" name="nv" list="nvv"  placeholder="スタッフ" style="width: 200px;padding-left:20px;" <?php if($_SESSION['PHANQUYEN']==1){echo "readonly";}else{echo "";} ?>/>
                                <?php $addnv=$get_data->select_nhanvien();?>
                                 <datalist id="nvv">
                                   <?php foreach($addnv as $seaddnv){?>
                                     <option value="<?php echo $seaddnv['NVID'];?>"><?php echo $seaddnv['NAMENV']; ?></option>
                                   <?php } ?>
                                 </datalist>
                              </div>
                              <div class="col-sm-3" style="padding-right:50px;">
                                <label>日付</label>
                                <input name="tu" type="date" class=""   style="width: 200px">
                              </div>
                              <div class="col-sm-3"style="padding-right:50px;">
                                <label>日付</label>
                                <input name="den" type="date" class=""   style="width: 200px">
                              </div>
                              <div class="col-sm-3" style="padding-right:50px;">
                                   <input type="submit" class="" name="timkiem" value="search" style="width: 100px;height: 50px;position: relative;left: 50px; top:31px;" />
                              </div>
                          </div>
                      </div>
          </form>
        </div>



        <form  class="hienthi" role="form" method="post" enctype="multipart/form-data" style="">
         <table class="table table-bordered table-striped table-responsive-stack"   id="tableOne">


           <?php
                 $stt=1;
                 if (isset($_POST['timkiem'])) { ?>

                 <thead>
                   <tr>
                       <th>NO</th>
                       <th>ID 社員</th>
                       <th>名前</th>
                       <th>入金額</th>


                   </tr>
               </thead>
               <tbody>
                   <?php
                   $stt=0;
                   $select_hoadon_id_quyen=$get_data->select_hoadon_nhanvien_nvquyen($_SESSION['username']);
                  if($_SESSION['PHANQUYEN']==0){$quyen= $result;}else{ $quyen=$select_hoadon_id_quyen; };

                   foreach($quyen as $se){ ?>
                       <tr>
                         <td><?php echo $stt ?></td>
                         <td><?php echo $se['NVID'] ?></td>
                         <td><?php echo $se['NAMENV'] ?></td>
                         <?php
                         if($_SESSION['PHANQUYEN']==0){
                           $tk=$get_data->search_doanhthu($_POST['tu'], $_POST['den'],$_POST['nv'],$se['NVID']);
                           $tk2=$get_data->search_doanhthu2($_POST['tu'], $_POST['den'],$_POST['nv'],$se['NVID']);
                           $tk3=$get_data->search_doanhthu3($_POST['tu'], $_POST['den'],$_POST['nv'],$se['NVID']);

                           $sesum_tk=$get_data-> sum_doanhthu_search($_POST['tu'], $_POST['den'],$_POST['nv'],$se['NVID']);
                           $sesum_tk2=$get_data-> sum_doanhthu_search2($_POST['tu'], $_POST['den'],$_POST['nv'],$se['NVID']);
                           $sesum_tk3=$get_data-> sum_doanhthu_search3($_POST['tu'], $_POST['den'],$_POST['nv'],$se['NVID']);
                         }else{
                           $tk=$get_data->search_doanhthu_nvid($_POST['tu'], $_POST['den'],$_POST['nv'],$_SESSION['username'],$se['NVID']);
                           $tk2=$get_data->search_doanhthu_nvid2($_POST['tu'], $_POST['den'],$_POST['nv'],$_SESSION['username'],$se['NVID']);
                           $tk3=$get_data->search_doanhthu_nvid3($_POST['tu'], $_POST['den'],$_POST['nv'],$_SESSION['username'],$se['NVID']);

                           $sesum_tk=$get_data->sum_doanhthu_tk_nvid($_POST['tu'], $_POST['den'],$_POST['nv'],$_SESSION['username']);
                           $sesum_tk2=$get_data->sum_doanhthu_tk_nvid2($_POST['tu'], $_POST['den'],$_POST['nv'],$_SESSION['username']);
                           $sesum_tk3=$get_data->sum_doanhthu_tk_nvid3($_POST['tu'], $_POST['den'],$_POST['nv'],$_SESSION['username']);
                          };

                           foreach($tk as $setkk){}
                           foreach($tk2 as $setkk2){}
                           foreach($tk3 as $setkk3){}

                           $sesumm=$setkk['sum'] + $setkk2['sum'] + $setkk3['sum'];
                          ?>
                         <td><?php if( $tk==null AND $tk2==null AND $tk3==null){echo '0';}else{ echo number_format($sesumm) ;}?></td>

                       </tr>
                   </tbody>


                   <?php $stt++;} ?>
                   <!-- </c:forEach> -->
             <?php }   else {  $stt=0;
               if($_SESSION['PHANQUYEN']==0){
                 $sesum=$get_data->sum_doanhthu();
               }else{
                 $sesum=$get_data->sum_doanhthu_nvid($_SESSION['username']);
                };

               ?>

                   <thead>
                   <tr>
                     <th>NO</th>
                     <th>ID 社員</th>
                     <th>名前</th>
                     <th>入金額</th>
                   </tr>
               </thead>
               <tbody>

               <?php
               $select_hoadon_id_quyen=$get_data->select_hoadon_nhanvien_nvquyen($_SESSION['username']);



              if($_SESSION['PHANQUYEN']==0){$quyen= $result;}else{ $quyen=$select_hoadon_id_quyen; };



               foreach( $quyen as $se){ ?>
                   <tr>
                     <td><?php echo $stt ?></td>
                     <td><?php echo $se['NVID'] ?></td>
                     <td><?php echo $se['NAMENV'] ?></td>
                     <?php $sumtiennv=$get_data->sum_doanhthu_tung_nv($se['NVID']);foreach($sumtiennv as $sesumm){}  ?>
                     <td><?php if( $sumtiennv==null){echo '0';}else{ echo number_format($sesumm['sum']);} ?></td>

                   </tr>
                   </tbody>
               <?php $stt++;} ?>

             <?php } ?>



         </table>
        </form>



        <div class="content">
          <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card card-stats">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-2 col-md-2">
                      <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-money-coins text-primary"></i>
                      </div>
                    </div>
                    <div class="col-10 col-md-10">
                      <div class="numbers">
                        <p class="card-category">従業員の総離職率</p>
                        <?php  if (isset($_POST['timkiem'])) {
                          foreach($sesum_tk as $se_tk){}
                          foreach($sesum_tk2 as $se_tk2){}
                          foreach($sesum_tk3 as $se_tk3){}
                          $sesummm=$se_tk['sum'] + $se_tk2['sum'] + $se_tk3['sum'];
                         ?>

                          <p class="card-title"><?php  echo number_format( $sesummm);?> <p>
                        <?php
                        }else {
                           foreach ($sesum as $sum){} ?>
                        <p class="card-title"><?php if($sesum==null){echo "0 vnđ";}else{echo number_format($sum['sum']) ;} } ?><p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>


        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
             // PHẦN HIỂN THỊ PHÂN TRANG
             // BƯỚC 7: HIỂN THỊ PHÂN TRANG
             // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
             if ($current_page > 1 && $total_page > 1){
                     echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="hoadonnhanvien.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
             }
             // Lặp khoảng giữa
             for ($i = 1; $i <= $total_page; $i++){
                 // Nếu là trang hiện tại thì hiển thị thẻ span
                 // ngược lại hiển thị thẻ a
                 if ($i == $current_page){
                     echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
                 }
                 else{
                     echo ' <li class="page-item"><a class="page-link" href="hoadonnhanvien.php?page='.$i.'">'.$i.'</a></li> ';
                 }
             }
             // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
             if ($current_page < $total_page && $total_page > 1){
                    echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="hoadonnhanvien.php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
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
