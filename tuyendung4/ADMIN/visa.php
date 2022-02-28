<?php
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt=$get_data->list_hoso($ID);
$slt2=$get_data->list_khachhang($ID);

$slus=$get_data->list_user($ID);
$del=$_GET['del'];
$dk = $get_data->delete_hoso($del);
$dele1=$get_data->delete_user_khachhang($del);
$dele2=$get_data->delete_khachhang($del);


foreach($slt as $selist){}
foreach($slt2 as $selist2){}


foreach($slus as $seus){}





  //BƯỚC 1: KẾT NỐI SQL
  // BƯỚC 2: TÌM TỔNG SỐ RECORDS
  $result = mysqli_query($conn, 'select count(VISAID) as total from visa');
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
  $result = mysqli_query($conn, "SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   LIMIT $start, $limit");
   ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ビザ申請 </title>
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
          $id='KH0000'.(string)$mid;
        }
        else if($mid < 99){
          $mid=$mid+1;
          $id='KH000'.(string)$mid;
        }
        else if($mid < 999){
          $mid=$mid+1;
          $id='KH00'.(string)$mid;
        }
        else if($mid < 9999){
          $mid=$mid+1;
          $id='KH0'.(string)$mid;
        }
        else if($mid < 99999){
          $mid=$mid+1;
          $id='KH'.(string)$mid;
        }


   $selectmax=$get_data->max_uid();
   foreach($selectmax as $semaxx)
   {}

  if(isset($_POST["add"])){
         $batloi_idkhach=$get_data->batloi_visa_id($_POST['idkhach']);
         $batloi_nv1=$get_data->batloi_visa_idnv($_POST['id_nv'],"1");
         $batloi_nv2=$get_data->batloi_visa_idnv($_POST['id_nv2'],"2");

           if (mysqli_num_rows($batloi_idkhach)>0 || mysqli_num_rows($batloi_nv1)>0 || mysqli_num_rows($batloi_nv2)>0  ) {
           $up_pic = $get_data->upload($_FILES['pdf']['tmp_name'],'images/'.$_FILES['pdf']['name']);
           $dk2 = $get_data->insert_hoso($_POST['idkhach'],$_POST['idkhach'], $_POST['id_ls'], $_POST['id_nv'],$_POST['id_nv2'], $_POST['id_lvisa'],$_POST['ngaylap'],$_POST['tenvisa'],$_POST['congtyxin'],$_POST['trangthaivisa'],$_POST['ngayxinvisa'],$_POST['ngaycapvisa'],$_POST['ngayhethanvisa'],$_FILES['pdf']['name'],$_POST['mota']);
           if($dk2){header("location:visa.php");}
         }
   }


 if(isset($_POST['edit'])){
   $batloi_idkhach=$get_data->batloi_visa_id($_POST['idkhach']);
   $batloi_nv1=$get_data->batloi_visa_idnv($_POST['id_nv'],"1");
   $batloi_nv2=$get_data->batloi_visa_idnv($_POST['id_nv2'],"2");
         if (mysqli_num_rows($batloi_idkhach)>0 || mysqli_num_rows($batloi_nv1)>0 || mysqli_num_rows($batloi_nv2)>0  ) {
            $dkk1= $get_data->visaid_update_hoadon($_POST['idkhach'],$_POST['id_edt']);
            if($_FILES['pdf']['name'] == ""){
              $dk = $get_data->update_hoso2($_POST['idkhach'], $_POST['idkhach'], $_POST['id_ls'], $_POST['id_nv'],$_POST['id_nv2'], $_POST['id_lvisa'],$_POST['ngaylap'],$_POST['tenvisa'],$_POST['congtyxin'],$_POST['trangthaivisa'],$_POST['ngayxinvisa'],$_POST['ngaycapvisa'],$_POST['ngayhethanvisa'],$_POST['mota'],$_POST['id_edt']);
              if($dk and $dkk1 ){header('location:visa.php');}
            }
            else {
              $up_pic = $get_data->upload($_FILES['pdf']['tmp_name'],'images/'.$_FILES['pdf']['name']);
              $dk = $get_data->update_hoso($_POST['idkhach'], $_POST['idkhach'], $_POST['id_ls'], $_POST['id_nv'],$_POST['id_nv2'], $_POST['id_lvisa'],$_POST['ngaylap'],$_POST['tenvisa'],$_POST['congtyxin'],$_POST['trangthaivisa'],$_POST['ngayxinvisa'],$_POST['ngaycapvisa'],$_POST['ngayhethanvisa'],$_FILES['pdf']['name'],$_POST['mota'],$_POST['id_edt']);
              if($dk  ){header('location:visa.php');}
            }
    }
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
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a class="active" style="color:black"  href="visa.php">ビザ申請</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="khachhang.php">顧客情報</a></li>
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
          <h1 >  ビザ書類</h1>
        </div>
        <div class="row" style="margin-top:20px;margin-bottom:10px;margin-left:10px;">
            <div class="btn-add" style="width:350px,border:20px;">
              <?php if($ID!=NULL){echo '<button type="button" class="btn" data-toggle="modal" style="background-color:black;color:white;" data-target="#myModaleadd">  EDIT ビザ書類   </button> <button type="button" class="btn" hea> <a href="visa.php">BACK</a> </button> '; } else{echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModaleadd">ビザ書類を追加する</button>';} ?>
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


    <?php   if(isset($_POST["timkiem5"])){
      if($_SESSION['PHANQUYEN']==0){
        $tk=$get_data->search_hoso($_POST['tu'], $_POST['den'],$_POST['name'],$_POST['nv']);
      }else{
        $tk=$get_data->search_hoso_idnv($_POST['tu'], $_POST['den'],$_POST['name'],$_POST['nv'],$_SESSION['username']);
       };
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
                       <th>ID 書類</th>
                       <th>人材担当1</th>
                       <th>人材担当2</th>
                       <!-- <th>外国人担当</th>
                       <th>案件担当</th> -->
                       <th>行政書士</th>
                       <!-- <th>着手日</th> -->
                       <th>ビザ種類</th>
                       <th>申請日</th>
                       <th>追加日</th>
                       <th>結果</th>
                       <!-- <th>会社名</th> -->
                       <th>状態</th>


                       <th style="width:20px;">PDF</th>
                   </tr>
               </thead>
               <tbody>
                   <?php
                   $stt=0;

                   foreach($tk as $se){ ?>
                     <tr >
                         <td align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                           <div class="row" style="margin:5px;width:130px">
                             <div style="margin-bottom:10px" class="btn-edit"><a href="visa.php?edit=<?php echo $se['KHID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                             <div style="margin-left:40px;" class="btn-del"><a href="visa.php?del=<?php echo $se['KHID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                           </div>
                         </td>
                         <td><?php echo $stt ?></td>

                        <td>
                          <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['KHID'];?></h1>
                          <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMEKH'] ?>)</h2>
                        </td>
                        <td>
                          <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NVID'];?></h1>
                        </td>
                        <td>
                          <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NV2ID'];?></h1>
                        </td>
                        <td>
                          <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['LSID'];?></h1>
                        </td>
                         <!-- <td><?php echo $se['NGAYLAP'] ?></td> -->
                         <td><?php echo $se['TENVISA'] ?></td>
                         <td><?php echo $se['NGAYXIN'] ?></td>
                         <td><?php echo $se['NGAYCAP'] ?></td>
                         <td><?php echo $se['NGAYHET'] ?></td>
                         <!-- <td><?php echo $se['CONGTYXIN'] ?></td> -->
                         <td><?php echo $se['TRANGTHAI'] ?></td>
                         <td ><a style="color:red;max-width:20px;" href="readfile.php?read=<?php echo $se['VISAID']; ?>" target="_blank"><?php if(strlen($se['name_file'])>30){echo substr ($se['name_file'],0,30)."...";}else{echo ($se['name_file']);};  ?></a></td>

                       </tr>
                       </tbody>


                   <?php $stt++;} ?>
                   <!-- </c:forEach> -->
             <?php }   else {  $stt=0; ?>
                   <thead>
                   <tr>
                   <th <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>></th>
                       <th>NO</th>
                       <th>ID 書類</th>
                       <th>人材担当1</th>
                       <th>人材担当2</th>
                       <!-- <th>外国人担当</th>
                       <th>案件担当</th> -->
                       <th>行政書士</th>
                       <!-- <th>着手日</th> -->
                       <th>ビザ種類</th>
                       <th>申請日</th>
                       <th>追加日</th>
                       <th>結果</th>
                       <!-- <th>会社名</th> -->
                       <th>状態</th>

                       <th style="width:20px;">PDF</th>


                   </tr>
               </thead>
               <tbody>

               <?php
               $select_hoadon_id_quyen=$get_data->select_hoso_nhanvien_nvquyen($_SESSION['username']);



              // if($_SESSION['PHANQUYEN']==0){$quyen= $result;}else{ $quyen=$select_hoadon_id_quyen; };
              $quyen= $result;


               foreach( $quyen as $se){ ?>
                 <tr >
                   <td align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                     <div class="row" style="margin:5px;width:130px">
                       <div style="margin-bottom:10px" class="btn-edit"><a href="visa.php?edit=<?php echo $se['KHID'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                       <div style="margin-left:40px;" class="btn-del"><a href="visa.php?del=<?php echo $se['KHID'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                     </div>
                   </td>
                   <td><?php echo $stt ?></td>

                  <td>
                    <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['KHID'];?></h1>
                    <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMEKH'] ?>)</h2>
                  </td>
                  <td>
                    <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NVID'];?></h1>
                  </td>
                  <td>
                    <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NV2ID'];?></h1>
                  </td>
                  <td>
                    <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['LSID'];?></h1>
                  </td>
                   <!-- <td><?php echo $se['NGAYLAP'] ?></td> -->
                   <td><?php echo $se['TENVISA'] ?></td>
                   <td><?php echo $se['NGAYXIN'] ?></td>
                   <td><?php echo $se['NGAYCAP'] ?></td>
                   <td><?php echo $se['NGAYHET'] ?></td>
                   <!-- <td><?php echo $se['CONGTYXIN'] ?></td> -->
                   <td><?php echo $se['TRANGTHAI'] ?></td>
                   <td ><a style="color:red;max-width:20px;" href="readfile.php?read=<?php echo $se['VISAID']; ?>" target="_blank"><?php if(strlen($se['name_file'])>30){echo substr ($se['name_file'],0,30)."...";}else{echo ($se['name_file']);};  ?></a></td>
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







    <!-- Modal -->
    <div class="modal fade" id="myModaleadd" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="section-txt" align=center>
              <h2 style="position:relative; right:200px;">ビザ申請</h2>
            </div>
          </div>

          <div class="modal-body">


             <form action=""  method="post" style="padding-left: 90px;padding-right: 90px;"enctype="multipart/form-data" >
               <input type="hidden" name="id_edt" value="<?php if($ID!=NULL){echo $selist['ID']; } else{echo '';} ?>">
                     <div class="form-group">
                         <div class="row">

                           <!-- <div class="col-sm-6">
                               <label>ID 書類</label>
                               <?php $maxid=$get_data->max_hoso_id();
                                     $idnvquyen=$get_data->select_hoso_nhanvien_nvquyen($_SESSION['username']);
                                     foreach($idnvquyen as $nvq){}
                               ?>
                              <?php foreach($maxid as $mid){}
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
                                ?>

                               <input name="id" type="text" value="<?php if($ID!=NULL){echo $selist['VISAID']; } else{echo $id;} ?>" class="form-control"  required  >
                           </div> -->
                           <div class="col-sm-12">
                               <label>顧客ID</label>
                               <input name="idkhach" type="text" list="khv" value="<?php if($ID!=NULL){echo $selist2['KHID']; } else{echo '';} ?>" class="form-control"    required  >
                               <?php $addkh=$get_data->select_khachhang();?>
                                <datalist id="khv">
                                  <?php foreach($addkh as $seaddkh){?>
                                    <option value="<?php echo $seaddkh['KHID']; ?>"><?php echo $seaddkh['NAMEKH']; ?></option>
                                  <?php } ?>
                                </datalist>
                           </div>

                         </div>
                     </div>
                     <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                              <label>着手日</label>
                              <input name="ngaylap" type="date" value="<?php if($ID!=NULL){echo $selist['NGAYLAP']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo "readonly"; } else{echo "";} ?>  required/>
                           </div>
                       </div>
                     </div>


               <div class="form-group">
                   <div class="row">
                        <div class="col-sm-12">
                          <label>行政書士</label>
                          <?php $addls=$get_data->select_lawyer();?>
                          <input  name="id_ls" type="text" value="<?php if($ID!=NULL){echo $selist['LSID']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?>  required/>
                        </div>
                       </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                           <div class="col-sm-4">
                             <label>ビザ種類</label>
                             <input name="tenvisa" type="text" value="<?php if($ID!=NULL){echo $selist['TENVISA']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?>  required/>
                          </div>
                          <div class="col-sm-4">
                            <label>会社名</label>
                            <input name="congtyxin" type="text" value="<?php if($ID!=NULL){echo $selist['CONGTYXIN']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?>  required/>
                         </div>
                          <div class="col-sm-4">
                            <label>状態</label>
                            <input name="trangthaivisa" type="text" value="<?php if($ID!=NULL){echo $selist['TRANGTHAI']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?>  required/>
                          </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                           <div class="col-sm-4">
                             <label>申請日</label>
                             <input name="ngayxinvisa" type="date" value="<?php if($ID!=NULL){echo $selist['NGAYXIN']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?> />
                          </div>
                          <div class="col-sm-4">
                            <label>追加日</label>
                            <input name="ngaycapvisa" type="date" value="<?php if($ID!=NULL){echo $selist['NGAYCAP']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?> />
                         </div>
                          <div class="col-sm-4">
                            <label>結果</label>
                            <input name="ngayhethanvisa" type="date" value="<?php if($ID!=NULL){echo $selist['NGAYHET']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?> />
                          </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                           <div class="col-sm-6">
                             <label>外国人担当</label>
                             <?php $addnv=$get_data->select_nhanvien();?>
                             <input  name="id_nv" value="<?php if($_SESSION['PHANQUYEN']==1){echo $nvq['NVID'];}else{if($ID!=NULL){echo $selist['NVID']; } else{echo "";}} ?>" type="text" list="nhanvien" <?php if($_SESSION['PHANQUYEN']==1){echo "readonly";}else{echo "";} ?> class="form-control"  required/>
                              <datalist id="nhanvien">
                                <?php foreach($addnv as $seaddnv){?>
                                  <option value="<?php echo $seaddnv['NVID'];?>"><?php echo $seaddnv['NAMENV']; ?></option>
                                <?php } ?>
                              </datalist>
                          </div>
                          <div class="col-sm-6">
                             <label>案件担当</label>
                             <?php $addnv=$get_data->select_nhanvien();?>
                             <input  name="id_nv2" value="<?php if($_SESSION['PHANQUYEN']==1){echo $nvq['NV2ID'];}else{if($ID!=NULL){echo $selist['NV2ID']; } else{echo "";}} ?>" type="text" list="nhanvien" <?php if($_SESSION['PHANQUYEN']==1){echo "readonly";}else{echo "";} ?> class="form-control"  required/>
                              <datalist id="nhanvien">
                                <?php foreach($addnv as $seaddnv){?>
                                  <option value="<?php echo $seaddnv['NV2ID'];?>"><?php echo $seaddnv['NAMENV2']; ?></option>
                                <?php } ?>
                              </datalist>
                          </div>
                          <div class="col-sm-12">
                            <label>ビザタイプID</label>
                            <?php $addvisa=$get_data->select_loaivissa();?>
                            <input  name="id_lvisa" type="text" list="loaivisaaa" value="<?php if($ID!=NULL){echo $selist['LOAIVISA']; } else{echo "";} ?>" class="form-control" <?php if($ID!=NULL){echo ""; } else{echo "";} ?>  required/>
                             <datalist id="loaivisaaa">
                               <?php foreach($addvisa as $seaddvisa){?>
                                 <option value="<?php echo $seaddvisa['LVISAID'];?>"><?php echo $seaddvisa['TENLOAI']; ?></option>
                               <?php } ?>
                             </datalist>
                          </div>
                      </div>
                    </div>






                     <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                              <label>PDF</label>
                              <input name="pdf" type="file" value="<?php if($ID!=NULL){echo $selist['name_file']; } else{echo "";} ?>" class="form-control"  />
                           </div>
                       </div>
                     </div>



                     <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                              <label>説明</label>
                              <textarea name="mota" type="file" style="height:200px;" value="" class="form-control"   required ><?php if($ID!=NULL){echo $selist['Mota']; } else{echo "";} ?></textarea>
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
