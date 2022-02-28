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
  $result = mysqli_query($conn, "SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID  LIMIT $start, $limit");
   ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>明細書 </title>
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
  if(isset($_POST["add"])){




    $batloi_idvisa=$get_data->batloi_hoadon_idvisa($_POST['id_kh']);
    $batloi_nv=$get_data->batloi_hoadon_idnv($_POST['id_nv']);

    if (mysqli_num_rows($batloi_idvisa)>0 || mysqli_num_rows($batloi_nv)>0   ) {
      if($_POST['ngaydongtien1']==null || $_POST['tien1']==null){
        $_POST['ngaydongtien1']=="0000-00-00";
        $_POST['tien1']=="0";
      }
      if($_POST['ngaydongtien2']==null || $_POST['tien2']==null){
        $_POST['ngaydongtien2']=="0000-00-00";
        $_POST['tien2']=="0";
      }
      if($_POST['ngaydongtien3']==null || $_POST['tien3']==null){
        $_POST['ngaydongtien3']=="0000-00-00";
        $_POST['tien3']=="0";
      }
      $tongtiendong=$_POST['tien1']+$_POST['tien2']+$_POST['tien3'];
      $dk = $get_data->insert_hoadon($_POST['id'], $_POST['id_kh'],$_POST['ngaylap'],$_POST['ngaydongtien1'],$_POST['tien1'],$_POST['ngaydongtien2'],$_POST['tien2'],$_POST['ngaydongtien3'],$_POST['tien3'],$tongtiendong, $_POST['id_nv'], $_POST['mota']);
     if($dk){
       header('location:hoadon.php');
     }
   }





}


if(isset($_POST['edit'])){
  $batloi_idvisa=$get_data->batloi_hoadon_idvisa($_POST['id_kh']);
  $batloi_nv=$get_data->batloi_hoadon_idnv($_POST['id_nv']);

    if (mysqli_num_rows($batloi_idvisa)>0 || mysqli_num_rows($batloi_nv)>0   ) {

  if($_POST['ngaydongtien1']==null || $_POST['tien1']==null){
    $_POST['ngaydongtien1']=="0000-00-00";
    $_POST['tien1']=="0";
  }
  if($_POST['ngaydongtien2']==null || $_POST['tien2']==null){
    $_POST['ngaydongtien2']=="0000-00-00";
    $_POST['tien2']=="0";
  }
  if($_POST['ngaydongtien3']==null || $_POST['tien3']==null){
    $_POST['ngaydongtien3']=="0000-00-00";
    $_POST['tien3']=="0";
  }

  $tongtiendong=$_POST['tien1']+$_POST['tien2']+$_POST['tien3'];


        $dk = $get_data->update_hoadon($_POST['id_kh'],$_POST['id'],$_POST['ngaydongtien2'],$_POST['tien2'],$_POST['ngaydongtien3'],$_POST['tien3'],$tongtiendong, $_POST['mota'], $_POST['id_nv']);
         if($dk){header('location:hoadon.php');}
 }
}
   ?>

    <div class="header">

      <!-- Navbar -->
      <div class="Navbar">
        <ul class="topnav">

          <div class="tavba">
            <li class="navbar-user">
              <a href="singout.php" style="color:black;"><i class="fa fa-power-off"></i>.Out</a>
            </li>
            <li class="navbar-singin">
                <a href="" style="color:black;"><i class="fa fa-user "></i> <?php echo $_SESSION['username']; ?> </a>
            </li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="video.php">ビデオ</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">ニュース</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a class="active" style="color:black"   href="hoadon.php">明細書</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="hoadonnhanvien.php">従業員の離職率</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="visa.php">ビザ申請</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="khachhang.php">顧客情報</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a    href="taikhoankhachhang.php">顧客口座</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="nhanvien.php">従業員アカウント</a></li>



          </div>
       </ul>
      </div>
      <!--END Navbar-->

    </div>

    <div class="section" style="margin: 20px;overflow:hidden">
      <div class="container-fuid">
        <div class="section-txt">
          <h1> 明細書</h1>
        </div>
        <div class="row" style="margin-top:20px;margin-bottom:10px;">
            <div class="btn-add" style="width:350px">
              <?php if($ID!=NULL){echo '<button type="button" class="btn" data-toggle="modal" style="background-color:black;color:white;" data-target="#myModaleadd">  EDIT 明細書   </button> <button type="button" class="btn" hea> <a href="hoadon.php">BACK</a> </button> '; } else{echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModaleadd">新しい請求書</button>';} ?>
            </div>


            <form  class="timkiem" method="post">
                      <div class="" style=" margin-top: 10px;position: relative;right:-150px;top:-10px;" >
                            <div class="row">
                                <div class="col-sm-2">
                                   <label>外国人担当</label>
                                   <input type="text" class="" name="nv" list="nvv"  placeholder="外国人担当" style="width: 150px;" <?php if($_SESSION['PHANQUYEN']==1){echo "readonly";}else{echo "";} ?>/>
                                   <?php $addnv=$get_data->select_nhanvien();?>
                                    <datalist id="nvv">
                                      <?php foreach($addnv as $seaddnv){?>
                                        <option value="<?php echo $seaddnv['NVID'];?>"><?php echo $seaddnv['NAMENV']; ?></option>
                                      <?php } ?>
                                    </datalist>
                                </div>
                                <div class="col-sm-2">
                                   <label>お客様名前</label>
                                   <input type="text" class="" name="name" list="khv"  placeholder="お客様名前" style="width: 150px;"/>
                                   <?php $addkh=$get_data->select_hoso();?>
                                    <datalist id="khv">
                                      <?php foreach($addkh as $seaddkh){?>
                                        <option value="<?php echo $seaddkh['KHID'];?>"><?php echo $seaddkh['NAMEKH']; ?></option>
                                      <?php } ?>
                                    </datalist>
                                </div>
                                <div class="col-sm-2">
                                  <label>日付</label>
                                  <input name="tu" type="date" class=""   style="width: 150px;">
                                </div>
                                <div class="col-sm-2">
                                  <label>日付</label>
                                  <input name="den" type="date" class=""   style="width: 150px;">
                                </div>
                                <div class="col-sm-2">
                                     <input type="submit" name="timkiem" value="search" style="width: 100px;height: 50px;position: relative;left: 50px; top:31px;" />
                                </div>
                            </div>
                        </div>
            </form>
        </div>




                <div class="content">
                  <div class="row">

        <?php
            if($_SESSION['PHANQUYEN']==0){
              $dongtienc=$get_data->count_landongtien();
            }else{
              $dongtienc=$get_data->count_landongtien_nvid($_SESSION['username']);
            };

       foreach($dongtienc as $ttv){}
         ?>

         <div class="col-lg-3 col-md-6 col-sm-6">
           <div class="card card-stats">
             <div class="card-body ">
               <div class="row">
                 <div class="col-5 col-md-4">
                   <div class="icon-big text-center icon-warning">
                     <i class="nc-icon nc-check-2 text-success"></i>
                   </div>
                 </div>
                 <div class="col-7 col-md-8">
                   <div class="numbers">
                     <p class="card-category">有料 1</p>
                     <p class="card-title"><?php echo $ttv['tien']  ?>/<?php echo $ttv['tong'] ?><p>
                   </div>
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
                                <i class="nc-icon nc-check-2 text-success"></i>
                              </div>
                            </div>
                            <div class="col-7 col-md-8">
                              <div class="numbers">
                                <p class="card-category">有料 2</p>
                                <p class="card-title"><?php echo $ttv['tien2']  ?>/<?php echo $ttv['tong'] ?><p>
                              </div>
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
                                <p class="card-category">有料 3</p>
                                <p class="card-title"><?php echo $ttv['tien3']  ?>/<?php echo $ttv['tong'] ?><p>
                              </div>
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
                                <i class="nc-icon nc-money-coins text-primary"></i>
                              </div>
                            </div>
                            <div class="col-7 col-md-8">
                              <div class="numbers">
                                <p class="card-category">請求額の合計</p>
                                <?php  if (isset($_POST['timkiem'])) {
                                  if($_SESSION['PHANQUYEN']==0){
                                    $tk=$get_data->search_hoadontuden_ten($_POST['tu'], $_POST['den'],$_POST['name'],$_POST['nv']);
                                    $sesum=$get_data->sum_hd_tong($_POST['tu'], $_POST['den'],$_POST['name'],$_POST['nv']);
                                  }else{
                                    $tk=$get_data->search_hoadontuden_ten_idnv($_POST['tu'], $_POST['den'],$_POST['name'],$_POST['nv'],$_SESSION['username']);
                                    $sesum=$get_data->sum_hd_tong_nvid($_POST['tu'], $_POST['den'],$_POST['name'],$_POST['nv'],$_SESSION['username']);
                                   };

                                } else {
                                    if($_SESSION['PHANQUYEN']==0){
                                      $sesum=$get_data->sum_hd();
                                    }else{
                                      $sesum=$get_data->sum_hd_nvid($_SESSION['username']);
                                    };
                                 }?>

                                <?php foreach ($sesum as $sum){} ?>
                                <p class="card-title"><?php echo number_format($sum['sum']); ?><p>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

            </div>










        <form  class="hienthi" role="form" method="post" enctype="multipart/form-data"style="overflow:auto;MAX-height:500px;">
         <table class="table table-bordered table-striped table-responsive-stack"   id="tableOne">


           <?php
                 $stt=1;
                 if (isset($_POST['timkiem'])) { ?>

                 <thead>
                   <tr>
                     <th  style="width:150px;" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>></th>

                     <th>NO</th>
                     <!-- <th>Mã hồ sơ</th> -->
                     <th>お客様名前</th>
                     <th>名前</th>
                     <th>Congty</th>
                     <th>登録日</th>
                     <th>内定後</th>
                     <th>許可後</th>
                     <th>合計</th>
                     <th>状態</th>


                   </tr>
               </thead>
               <tbody>
                   <?php
                   $stt=0;

                   foreach($tk as $se){ ?>
                       <tr>
                         <td  style="width:200px;" align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                           <div class="row" style="margin:5px;">
                             <div style="margin-bottom:10px;" class="btn-edit"><a href="hoadon.php?edit=<?php echo $se['idhoadon'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                             <div style=";" class="btn-del"><a href="hoadon.php?del=<?php echo $se['idhoadon'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                           </div>
                         </td>
                         <td><?php echo $stt ?></td>

                         <!-- <td><?php echo $se['VISAID'] ?></td> -->
                         <td>
                           <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['KHID'];?></h1>
                           <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMEKH'];?>)</h2>
                         </td>
                         <td>
                           <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NAMENV'];?></h1>
                         </td>
                         <td>
                           <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NVCONGTY'];?></h1>
                         </td>
                         <td>
                           <h1 style="font-size: 18;font-weight: 500;"><?php echo number_format($se['TIEN']);?></h1>
                           <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NGAYDONGTIEN'];?>)</h2>
                         </td>
                         <td>
                           <h1 style="font-size: 18;font-weight: 500;"><?php echo number_format($se['TIEN2']);?></h1>
                           <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NGAYDONG2'];?>)</h2>
                         </td>
                         <td>
                           <h1 style="font-size: 18;font-weight: 500;"><?php echo number_format($se['TIEN3']);?></h1>
                           <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NGAYDONG3'];?>)</h2>
                         </td>
                         <td><?php echo number_format($se['TONGTIEN']);?></td>
                          <td><?php echo $se['Motahd'];?></td>

                       </tr>
                   </tbody>


                   <?php $stt++;} ?>
                   <!-- </c:forEach> -->
             <?php }   else {  $stt=0; ?>
                   <thead>
                   <tr>
                     <th  style="width:150px;" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>></th>

                     <th>NO</th>
                     <!-- <th>Mã hồ sơ</th> -->
                     <th>お客様名前</th>
                     <th>名前</th>
                     <th>Congty</th>
                     <th>登録日</th>
                     <th>内定後</th>
                     <th>許可後</th>
                     <th>合計</th>
                     <th>状態</th>
                   </tr>
               </thead>
               <tbody>

               <?php
               $select_hoadon_id_quyen=$get_data->select_hoadon_nvquyen($_SESSION['username']);



              if($_SESSION['PHANQUYEN']==0){$quyen= $result;}else{ $quyen=$select_hoadon_id_quyen; };



               foreach( $quyen as $se){ ?>
                   <tr>
                     <td   align="center" <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>>
                       <div class="row" style="margin:5px;width:130px">
                         <div style="margin-bottom:10px; margin-right:25px;" class="btn-edit"><a href="hoadon.php?edit=<?php echo $se['idhoadon'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                         <div style=";" class="btn-del"><a href="hoadon.php?del=<?php echo $se['idhoadon'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                       </div>
                     </td>
                     <td><?php echo $stt ?></td>
                     <!-- <td><?php echo $se['VISAID'] ?></td> -->
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['KHID'];?></h1>
                       <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NAMEKH'];?>)</h2>
                     </td>
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NAMENV'];?></h1>
                     </td>
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo $se['NVCONGTY'];?></h1>
                     </td>
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo number_format($se['TIEN']);?></h1>
                       <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NGAYDONGTIEN'];?>)</h2>
                     </td>
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo number_format($se['TIEN2']);?></h1>
                       <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NGAYDONG2'];?>)</h2>
                     </td>
                     <td>
                       <h1 style="font-size: 18;font-weight: 500;"><?php echo number_format($se['TIEN3']);?></h1>
                       <h2 style="font-size: 15;font-weight: 500;"> (<?php echo $se['NGAYDONG3'];?>)</h2>
                     </td>
                     <td><?php echo number_format($se['TONGTIEN']);?></td>
                      <td><?php echo $se['Motahd'];?></td>



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
                     echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="hoadon.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
             }
             // Lặp khoảng giữa
             for ($i = 1; $i <= $total_page; $i++){
                 // Nếu là trang hiện tại thì hiển thị thẻ span
                 // ngược lại hiển thị thẻ a
                 if ($i == $current_page){
                     echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
                 }
                 else{
                     echo ' <li class="page-item"><a class="page-link" href="hoadon.php?page='.$i.'">'.$i.'</a></li> ';
                 }
             }
             // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
             if ($current_page < $total_page && $total_page > 1){
                    echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="hoadon.php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
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
              <h2 style="position:relative; right:335px;">明細書</h2>
            </div>
          </div>

          <div class="modal-body">


             <form action=""  method="post" style="padding-left: 90px;padding-right: 90px;" >
               <div class="form-group">
                   <div class="row">
                       <div class="col-sm-4" hidden>
                           <?php $maxid=$get_data->max_hoadon_id();
                                 $idnvquyen=$get_data->select_nhanvien_ID_Quyen($_SESSION['username']);
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

                           <input name="id" type="hidden" value="<?php if($ID!=NULL){echo $selist['idhoadon']; } else{echo $id;} ?>" class="form-control" <?php if($ID!=NULL){echo "readonly"; } else{echo "";} ?> required  >
                       </div>
                       <div class="col-sm-6">
                            <label>登録番号</label>
                            <?php $addkh=$get_data->select_hoso();?>
                            <input name="id_kh" type="text" list="khachhang" value="<?php if($ID!=NULL){echo $selist['IDHOSO']; } else{echo "";} ?>" class="form-control"  required/>
                             <datalist id="khachhang">
                               <?php foreach($addkh as $seaddkh){?>
                                 <option value="<?php echo $seaddkh['VISAID']; ?>"><?php echo $seaddkh['NAMEKH']; ?></option>
                               <?php } ?>
                             </datalist>
                       </div>
                       <div class="col-sm-6">
                         <label>ID 名前</label>
                         <?php $addnv=$get_data->select_nhanvien();?>
                         <input  name="id_nv" value="<?php if($_SESSION['PHANQUYEN']==1){echo $nvq['NVID'];}else{if($ID!=NULL){echo $selist['NVID']; } else{echo "";}} ?>" type="text" list="nhanvien" <?php if($_SESSION['PHANQUYEN']==1){echo "readonly";}else{echo "";} ?> class="form-control"  required/>
                          <datalist id="nhanvien">
                            <?php foreach($addnv as $seaddnv){?>
                              <option value="<?php echo $seaddnv['NVID'];?>"><?php echo $seaddnv['NAMENV']; ?></option>
                            <?php } ?>
                          </datalist>
                      </div>


                       </div>
                    </div>



                     <div class="form-group">
                       <div class="row">
                         <div class="col-sm-6">
                           <label>支払日1</label>
                           <input name="ngaydongtien1" type="date" value="<?php if($ID!=NULL){echo $selist['NGAYDONGTIEN']; } else{echo "";} ?>" class="form-control"   required/>
                         </div>
                         <div class="col-sm-6">
                              <label>登録日 </label>
                              <input name="tien1" type="text" value="<?php if($ID!=NULL){echo $selist['TIEN']; } else{echo "";} ?>" class="form-control"  required  >
                         </div>

                       </div>
                     </div>

                     <div class="form-group">
                       <div class="row">
                         <div class="col-sm-6">
                           <label>支払日2</label>
                           <input name="ngaydongtien2" type="date" value="<?php if($ID!=NULL){echo $selist['NGAYDONG2']; } else{echo "";} ?>" class="form-control" style="">
                         </div>
                         <div class="col-sm-6">
                              <label>内定後 </label>
                              <input name="tien2" type="text" value="<?php if($ID!=NULL){echo $selist['TIEN2']; } else{echo "";} ?>" class="form-control"  >
                         </div>

                       </div>
                     </div>


                     <div class="form-group">
                       <div class="row">
                         <div class="col-sm-6">
                           <label>支払日3</label>
                           <input name="ngaydongtien3" type="date" value="<?php if($ID!=NULL){echo $selist['NGAYDONG3']; } else{echo "";} ?>" class="form-control" style="">
                         </div>
                         <div class="col-sm-6">
                              <label>許可後 </label>
                              <input name="tien3" type="text" value="<?php if($ID!=NULL){echo $selist['TIEN3']; } else{echo "";} ?>" class="form-control"  >
                         </div>

                       </div>
                     </div>



                     <div class="form-group">
                          <label>説明</label>
                          <textarea name="mota" type="text" value="" class="form-control" style="height:100px;"  required  ><?php if($ID!=NULL){echo $selist['Motahd']; } else{echo "";} ?></textarea>
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
