<?php
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt2=$get_data->list_khachhang($ID);

$slus=$get_data->list_user($ID);
$del=$_GET['del'];
$dele1=$get_data->delete_user_khachhang($del);
$dele2=$get_data->delete_khachhang($del);


foreach($slt as $selist){}
foreach($slt2 as $selist2){}


foreach($slus as $seus){}





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
  $result = mysqli_query($conn, "SELECT * FROM users INNER JOIN khachhang ON users.USERID=khachhang.USERID LIMIT $start, $limit");
   ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>顧客情報 </title>
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
  <?php

        $selectmax=$get_data->max_uid();//gọi đến function.
        foreach($selectmax as $semax){}

        $maxid=$get_data->max_khachhang_id();
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


   $selectmax=$get_data->max_uid();
   foreach($selectmax as $semaxx)
   {}

  if(isset($_POST["add"])){

    $PHANQUYEN=2;
    if ($_POST['password']!=$_POST['repass']) {
       $message = "Password nhập lại không đúng";
       echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else {
       $dk = $get_data->dangky_khach($semaxx['max'],$_POST['username'], $_POST['password'],$PHANQUYEN);
       $dk1 = $get_data->insert_khachhang($_POST['idkhach'],$_POST['hoten'], $_POST['phone'], $_POST['email'], $_POST['diachi'],$semaxx['max'], $_POST['gioitinh'], $_POST['bangcap'], $_POST['langluc'], $_POST['nguyenvong'], $_POST['trangthaiviec'], $_POST['quoctich'],$_POST['congtyxin'],$_POST['NGAYLAP']);

         if (!isset($dk)) {
           $dk = $get_data->delete_tk($_POST['username']);
         }
         if (!isset($dk1)) {
           $dk = $get_data->delete_khachhang($_POST['idkhach']);
         }

         if($dk and $dk1){header("location:khachhang.php");

       }
     }
}


if(isset($_POST['edit'])){
        $dkk1= $get_data->khid_update_visa($_POST['idkhach'],$_POST['id']);
        $dkk2= $get_data->khid_update_hoadon($_POST['idkhach'],$_POST['id']);
        $dk = $get_data->update_khachhang($_POST['idkhach'],$_POST['hoten'], $_POST['phone'], $_POST['email'], $_POST['diachi'],
        $_POST['gioitinh'], $_POST['bangcap'], $_POST['langluc'], $_POST['nguyenvong'], $_POST['trangthaiviec'],
        $_POST['quoctich'], $_POST['congtyxin'],$_POST['id']);

         if($dkk ){header('location:khachhang.php');}
 }
   ?>

    <div class="header" >

      <!-- Navbar -->
      <div class="Navbar">
        <ul class="topnav">

          <div class="tavba">
            <li class="navbar-user">
              <a href="singout.php" style="color:black"><i class="fa fa-power-off"></i>.Out</a>
            </li>
              <!-- <a href="doi_mk.php"><i class=""></i>Change password</a>
            </li> -->
            <li class="navbar-singin">
                <a href="" style="color:black"><i class="fa fa-user "></i> <?php echo $_SESSION['username']; ?> </a>
            </li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="video.php">ビデオ</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">ニュース</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="hoadon.php">明細書</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="hoadonnhanvien.php">従業員の離職率</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="visa.php">ビザ申請</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a class="active" style="color:black" href="khachhang.php">顧客情報</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="taikhoankhachhang.php">顧客口座</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="nhanvien.php">従業員アカウント</a></li>




          </div>
       </ul>
      </div>
      <!--END Navbar-->

    </div>

    <div class="section" >
      <div class="container-fuid">
        <div class="section-txt">
            <h1 >顧客情報</h1>
        </div>
        <div class="row" style="margin-top:20px;margin-bottom:10px;margin-left:10px;">
            <div class="btn-add" style="width:350px,border:20px;">
              <?php if($ID!=NULL){echo '<button type="button" class="btn" data-toggle="modal" style="background-color:black;color:white;" data-target="#myModaleadd">
                 EDIT 顧客情報   </button> <button type="button" class="btn" hea> <a href="visa.php">BACK</a> </button> '; } else{echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModaleadd">より多くの顧客</button>';} ?>
            </div>


            <form  class="timkiem" method="post" >
                      <div class="" style=" margin-top: 10px;position: relative;right:-130px;top:-10px;" >
                            <div class="row">

                                <div class="col-sm-3">
                                   <label>お客様</label>
                                   <input type="text" class="" name="name" list="khv"  placeholder="お客様" style="width: 150px;"/>
                                   <?php $addkh=$get_data->select_khachhang();?>
                                    <datalist id="khv">
                                      <?php foreach($addkh as $seaddkh){?>
                                        <option value="<?php echo $seaddkh['KHID']; ?>"><?php echo $seaddkh['NAMEKH']; ?></option>
                                      <?php } ?>
                                    </datalist>
                                </div>
                                <div class="col-sm-3">
                                  <label>日付</label>
                                  <input name="tu" type="date" class=""   style="width: 150px;">
                                </div>
                                <div class="col-sm-3">
                                  <label>日付</label>
                                  <input name="den" type="date" class=""   style="width: 150px;">
                                </div>
                                <div class="col-sm-3">
                                     <input type="submit" class="" name="timkiem5" value="search" style="width: 100px;height: 50px;position: relative;left: 50px; top:31px;" />
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
                        <p class="card-category">面接まだ</p>
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
                           <input class="form-control" type="submit" name="timkiem1" value="画面">
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
                        <p class="card-category">結果待ち</p>
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
                           <input class="form-control" type="submit" name="timkiem2" value="画面">
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
                        <p class="card-category">内定した</p>
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
                           <input class="form-control" type="submit" name="timkiem3" value="画面">
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
                        <p class="card-category">キャンセル</p>
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
                           <input class="form-control" type="submit" name="timkiem4" value="画面">
                        </from>
                    </div>
                  </div>
                </div>

              </div>
            </div>



          </div>
    </div>

    <?php   if(isset($_POST["timkiem5"])){
        $tk=$get_data->search_hosokhachhang($_POST['tu'], $_POST['den'],$_POST['name']);

    } ?>

<div class=""style="margin: 20px;">



        <form  class="hienthi" role="form" method="post" enctype="multipart/form-data" >
         <table class="table table-bordered table-striped table-responsive-stack"   id="tableOne">
           <?php
                 $stt=1;
                 if ($tk!=null||$tk!="") { ?>

                 <thead>
                   <tr>
                       <th <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>></th>
                       <th>NO</th>
                       <th>番号</th>
                       <th>名前</th>
                       <!-- <th>人材担当1</th>
                       <th>人材担当2</th> -->
                       <th>国籍 </th>
                       <th>電話番号</th>
                       <th>メール</th>
                       <th>現住所</th>
                       <th>性別</th>
                       <th>学歴</th>
                       <th>日本語能力</th>
                       <th>エリア希望</th>
                       <th>会社名</th>
                       <th>状態</th>
                   </tr>
               </thead>
               <tbody>
                   <?php



                   $stt=0;

                   foreach($tk as $se){ ?>
                     <tr style="<?php if ($se['trangthaiviec']=="面接まだ") {
                               echo "";
                          }else if($se['trangthaiviec']=="結果待ち") {
                               echo "background-color:#528B8B;color:black;";
                          }else if($se['trangthaiviec']=="内定した") {
                                echo "background-color:#EEAD0E;color:black;";
                          }else if($se['trangthaiviec']=="キャンセル") {
                                echo "background-color:gray;color:white;";
                     } ?>">
                         <td align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                           <div class="row" style="margin:5px;width:130px">
                             <div style="margin-bottom:10px" class="btn-edit"><a href="khachhang.php?edit=<?php echo $se['KHID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                             <div style="margin-left:40px;" class="btn-del"><a href="khachhang.php?del=<?php echo $se['KHID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                           </div>
                         </td>
                         <td><?php echo $stt ?></td>
                         <td><?php echo $se['KHID'] ?></td>
                         <td><?php echo $se['NAMEKH'] ?></td>
                         <!--  -->
                         <td><?php echo $se['quoctich'] ?></td>
                         <td><?php echo $se['PHONEKH'] ?></td>
                         <td><?php echo $se['EMAIL'] ?></td>
                         <td><?php echo $se['DIACHI'] ?></td>
                         <td><?php echo $se['gioitinh'] ?></td>
                         <td><?php echo $se['bangcap'] ?></td>
                         <td><?php echo $se['nangluc'] ?></td>
                          <td><?php echo $se['nguyenvong'] ?></td>
                            <td><?php echo $se['CONGTYXIN'] ?></td>
                          <td><?php echo $se['trangthaiviec'] ?></td>


                       </tr>
                       </tbody>


                   <?php $stt++;} ?>
                   <!-- </c:forEach> -->
             <?php }   else {  $stt=0; ?>
                   <thead>
                   <tr>
                   <th <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>></th>
                       <th>NO</th>
                       <th>番号</th>
                       <th>名前</th>

                       <th>国籍 </th>
                       <th>電話番号</th>
                       <th>メール</th>
                       <th>現住所</th>
                       <th>性別</th>
                       <th>学歴</th>
                       <th>日本語能力</th>
                       <th>エリア希望</th>
                       <th>会社名</th>
                       <th>状態</th>

                   </tr>
               </thead>
               <tbody>

               <?php
               $select_hoadon_id_quyen=$get_data->select_hoso_nhanvien_nvquyen($_SESSION['username']);



              // if($_SESSION['PHANQUYEN']==0){$quyen= $result;}else{ $quyen=$select_hoadon_id_quyen; };
              $quyen= $result;


               foreach( $quyen as $se){ ?>
                 <tr style="<?php if ($se['trangthaiviec']=="面接まだ") {
                           echo "";
                      }else if($se['trangthaiviec']=="結果待ち") {
                           echo "background-color:#528B8B;color:black;";
                      }else if($se['trangthaiviec']=="内定した") {
                            echo "background-color:#EEAD0E;color:black;";
                      }else if($se['trangthaiviec']=="キャンセル") {
                            echo "background-color:gray;color:white;";
                 } ?>">
                     <td align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                       <div class="row" style="margin:5px;width:130px">
                         <div style="margin-bottom:10px" class="btn-edit"><a href="khachhang.php?edit=<?php echo $se['KHID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                         <div style="margin-left:40px;" class="btn-del"><a href="khachhang.php?del=<?php echo $se['KHID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                       </div>
                     </td>
                     <td><?php echo $stt ?></td>
                     <td><?php echo $se['KHID'] ?></td>
                     <td><?php echo $se['NAMEKH'] ?></td>

                     <td><?php echo $se['quoctich'] ?></td>
                     <td><?php echo $se['PHONEKH'] ?></td>
                     <td><?php echo $se['EMAIL'] ?></td>
                     <td><?php echo $se['DIACHI'] ?></td>
                     <td><?php echo $se['gioitinh'] ?></td>
                     <td><?php echo $se['bangcap'] ?></td>
                     <td><?php echo $se['nangluc'] ?></td>
                      <td><?php echo $se['nguyenvong'] ?></td>
                        <td><?php echo $se['CONGTYXIN'] ?></td>
                      <td><?php echo $se['trangthaiviec'] ?></td>
                   </tr>
                   </tbody>
               <?php $stt++;} ?>

             <?php } ?>



         </table>
        </form>
        </div>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
             // PHẦN HIỂN THỊ PHÂN TRANG
             // BƯỚC 7: HIỂN THỊ PHÂN TRANG
             // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
             if ($current_page > 1 && $total_page > 1){
                     echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="khachhang.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
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
                    echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="visa
                    .php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
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
              <h2 style="position:relative; right:200px;">より多くの顧客</h2>
            </div>
          </div>

          <div class="modal-body">


             <form action=""  method="post" style="padding-left: 90px;padding-right: 90px;"enctype="multipart/form-data" >
               <input type="hidden" name="id" value="<?php if($ID!=NULL){echo $selist2['ID']; } else{echo '';} ?>">
               <div class="form-group">
                   <div class="row">
                       <div class="col-sm-4">
                           <label> アカウント</label>
                           <input name="username" type="text" value="" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>  required  >
                       </div>
                       <div class="col-sm-4">
                           <label>パスワード</label>
                           <input name="password" type="password" value="" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>  required  >
                       </div>
                       <div class="col-sm-4">
                           <label>confirmPassword</label>
                           <input name="repass" type="password" value="" class="form-control" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?>   required  >
                       </div>
                   </div>
               </div>

                     <div class="form-group">
                         <div class="row">
                           <div class="col-sm-12">
                               <label>番号</label>
                               <input name="idkhach" type="text" value="<?php if($ID!=NULL){echo $selist2['KHID']; } else{echo $id;} ?>" class="form-control"    required  >
                           </div>
                         </div>
                     </div>
                     <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                              <label>Ngày lập</label>
                              <input name="NGAYLAP" type="date" value="<?php if($ID!=NULL){echo $selist2['NGAYLAP']; } else{echo "";} ?>"  class="form-control" <?php if($ID!=NULL){echo "readonly"; } else{echo "";} ?>  required/>
                           </div>
                       </div>
                     </div>
                     <div class="form-group">
                         <div class="row">
                             <div class="col-sm-4">
                                 <label>名前</label>
                                 <input name="hoten" type="text" value="<?php if($ID!=NULL){echo $selist2['NAMEKH']; } else{echo '';} ?>" <?php if($ID!=NULL){echo 'readonly'; } else{echo '';} ?> class="form-control"  required  >
                             </div>
                             <div class="col-sm-4">
                                 <label>性別</label>
                                 <select name="gioitinh" type="text" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?> required >
                                   <option value="<?php if($ID!=NULL){echo $selist2['gioitinh']; } else{echo "";} ?>"><?php if($ID!=NULL){echo $selist2['gioitinh']; } else{echo "--オプション--";} ?></option>
                                   <option value="nam">男</option>
                                   <option value="nu">女</option>
                                 </select>
                             </div>
                             <div class="col-sm-4">
                                 <label>学歴</label>
                                 <input name="bangcap" type="text" value="<?php if($ID!=NULL){echo $selist2['bangcap']; } else{echo '';} ?>" class="form-control"  required  >
                             </div>

                         </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                             <div class="col-sm-4">
                                <label>メール</label>
                                <input name="email" type="email" value="<?php if($ID!=NULL){echo $selist2['EMAIL']; } else{echo '';} ?>" class="form-control"  required  >
                            </div>
                            <div class="col-sm-4">
                                <label>電話番号</label>
                                <input name="phone" type="text" value="<?php if($ID!=NULL){echo $selist2['PHONEKH']; } else{echo '';} ?>" class="form-control"  required  >
                            </div>
                            <div class="col-sm-4">
                                <label>現住所</label>
                                <input name="diachi" type="text" value="<?php if($ID!=NULL){echo $selist2['DIACHI']; } else{echo '';} ?>" class="form-control"  required  >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>国籍</label>
                        <input name="quoctich" type="text"  value="<?php if($ID!=NULL){echo $selist2['bangcap']; } else{echo '';} ?>" class="form-control"  required  >
                    </div>

                     <div class="form-group">
                         <label>日本語能力</label>
                         <input name="langluc" type="text"  value="<?php if($ID!=NULL){echo $selist2['nangluc']; } else{echo '';} ?>" class="form-control"  required  >
                     </div>


                     <div class="form-group">
                         <label>エリア希望</label>
                         <textarea name="nguyenvong" class="form-control" required style="height: 100px;"><?php if($ID!=NULL){echo $selist2['DIACHI']; } else{echo '';} ?></textarea>
                     </div>

                     <!-- <div class="form-group">
                       <div class="row">
                            <div class="col-sm-6">
                              <label>人材担当1</label>
                              <?php $addnv=$get_data->select_nhanvien();?>
                              <input  name="id_nv" value="<?php if($_SESSION['PHANQUYEN']==1){echo $nvq['NVID'];}else{if($ID!=NULL){echo $selist2['NVID']; } else{echo "";}} ?>" type="text" list="nhanvien" <?php if($_SESSION['PHANQUYEN']==1){echo "readonly";}else{echo "";} ?> class="form-control" <?php if($ID!=NULL){echo "readonly"; } else{echo "";} ?>  required/>
                               <datalist id="nhanvien">
                                 <?php foreach($addnv as $seaddnv){?>
                                   <option value="<?php echo $seaddnv['NVID'];?>"><?php echo $seaddnv['NAMENV']; ?></option>
                                 <?php } ?>
                               </datalist>
                           </div>
                           <div class="col-sm-6">
                              <label>人材担当2</label>
                              <?php $addnv=$get_data->select_nhanvien();?>
                              <input  name="id_nv2" value="<?php if($_SESSION['PHANQUYEN']==1){echo $nvq['NVID'];}else{if($ID!=NULL){echo $selist2['NVID']; } else{echo "";}} ?>" type="text" list="nhanvien" <?php if($_SESSION['PHANQUYEN']==1){echo "readonly";}else{echo "";} ?> class="form-control" <?php if($ID!=NULL){echo "readonly"; } else{echo "";} ?>  required/>
                               <datalist id="nhanvien">
                                 <?php foreach($addnv as $seaddnv){?>
                                   <option value="<?php echo $seaddnv['NV2ID'];?>"><?php echo $seaddnv['NAMENV2']; ?></option>
                                 <?php } ?>
                               </datalist>
                           </div>

                       </div>
                     </div> -->
                   <div class="form-group row">
                    <div class="col-sm-12">
                       <label>会社名</label>
                       <input name="congtyxin" type="text" value="<?php if($ID!=NULL){echo $selist2['CONGTYXIN']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?>  required/>
                    </div>
                  </div>

                     <div class="form-group">
                         <label>状態</label>
                         <select name="trangthaiviec" type="text" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?> required >
                           <option value="<?php if($ID!=NULL){echo $selist2['trangthaiviec']; } else{echo "";} ?>"><?php if($ID!=NULL){echo $selist2['trangthaiviec']; } else{echo "--オプション--";} ?></option>
                           <option value="面接まだ">面接ま</option>
                           <option value="結果待ち">結果待ち</option>
                           <option value="内定した">内定した </option>
                           <option value="キャンセル">キャンセル</option>

                         </select>
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
