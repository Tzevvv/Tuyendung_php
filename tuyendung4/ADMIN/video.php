<?php
ob_start();
error_reporting(0);
include('control.php');
$get_data=new data();//gọi đến class
include("singin_auth.php");


$ID=0;
$ID=$_GET['edit'];
$slt=$get_data->list_video($ID);

$del=$_GET['del'];
$dk = $get_data->delete_video($del);



foreach($slt as $selist){}

  //BƯỚC 1: KẾT NỐI SQL
  // BƯỚC 2: TÌM TỔNG SỐ RECORDS
  $result = mysqli_query($conn, 'select count(IDVIDEO) as total from video');
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
  $result = mysqli_query($conn, "select * from video LIMIT $start, $limit");
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Customized Bootstrap Stylesheet -->
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css\csss3.css" rel="stylesheet">
</head>

<body class="body">

  <?php

  $maxid=$get_data->max_video();
  foreach($maxid as $mid){}
  $mid=(int)$mid['max'];

  if($mid < 9){
    $mid=$mid+1;
    $id='VIDEO0000'.(string)$mid;
  }
  else if($mid < 99){
    $mid=$mid+1;
    $id='VIDEO000'.(string)$mid;
  }
  else if($mid < 999){
    $mid=$mid+1;
    $id='VIDEO00'.(string)$mid;
  }
  else if($mid < 9999){
    $mid=$mid+1;
    $id='VIDEO0'.(string)$mid;
  }
  else if($mid < 99999){
    $mid=$mid+1;
    $id='VIDEO'.(string)$mid;
  }

if(isset($_POST['add'])){

  $db = new data();
  if(empty($_POST['id']))
  echo "<script> alert('Not data on name') </script>";

  else {
  $up_pic = $db->upload($_FILES['video']['tmp_name'],'video/'.$_FILES['video']['name']);
          $in_tintuc = $db->inser_video($_POST['id'],$_POST['ngaydang'],$_POST['tieude'],$_POST['noidung'],$_FILES['video']['name']);
  if($in_tintuc)
   echo "<script>alert('sucessful')</script>";

  else
      echo "<script> alert('not sucessful')</script>";
  }

if( $dk)
{
header('location:video.php');
}
//  header('location:hienthisanpham.php');

else
echo "<script> alert('not sucessful')</script>";
}




if(isset($_POST['edit'])){
if(empty($_POST["id"])) echo "<script> alert('Not data on name') </script>";

  $dk_tintucka = $get_data->update_video($_POST['id'],$_POST['ngaydang'],$_POST['tieude'],$_POST['noidung']);
  if($dk_tintucka)
  header('location:video.php');
  else echo "<script>Không thành công</script>";
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
                    <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a style="color:black"  class="active"  href="video.php">ビデオ</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a href="tintuc.php">ニュース</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="hoadon.php">明細書</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="hoadonnhanvien.php">従業員の離職率</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a   href="visa.php">ビザ申請</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a  href="khachhang.php">顧客情報</a></li>
            <li <?php if($_SESSION['PHANQUYEN']<=1){echo "";}else{echo "hidden";} ?>><a     href="taikhoankhachhang.php">顧客口座</a></li>
            <li <?php if($_SESSION['PHANQUYEN']==0){echo "";}else{echo "hidden";} ?>><a  href="nhanvien.php">従業員アカウント</a></li>

                </div>
            </ul>
        </div>
        <!--END Navbar-->

    </div>

    <div class="section" style="margin: 20px;overflow:hidden">
      <div class="container-fuid">
            <div class="section-txt">
                <h1>VIDEO</h1>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="btn-add">
                        <?php if($ID!=NULL){echo '<button type="button" class="btn" data-toggle="modal" style="background-color:black;color:white;" data-target="#myModaleadd">  EDIT VIDEO   </button> <button type="button" class="btn" hea> <a href="tintuc.php">BACK</a> </button> '; } else{echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModaleadd">ADD NEW</button>';} ?>
                    </div>
                </div>
            </div>

            <form class="hienthi" role="form" method="post" enctype="multipart/form-data" style="overflow: auto;">
                <table class="table table-bordered table-striped table-responsive-stack" id="tableOne">
                    <tr>
                        <th> </th>
                        <th>NO</th>
                        <th>コードビデオ</th>
                        <th>ビデオタイトル</th>
                        <th>ビデオコンテンツ</th>
                        <th style="width:200px;"> ビデオ</th>


                    </tr>
                    <?php
           $stt=1;
           if (isset($_POST['timkiem'])) {
              $tk=$get_data->search_tintuc($_POST['search']);

           ?>

                    <?php $stt=0; foreach($tk as $se){ ?>
                    <tr>
                      <td align="center">
                          <div class="row">
                              <div class="btn-edit"><a href="tintuc.php?edit=<?php echo $se['TID'];?>"
                                      data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i
                                              class="fas fa-edit"></i></button></a> </div>
                              <div class="btn-del"><a href="tintuc.php?del=<?php echo $se['TID'];?>"
                                      onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button
                                          type="button" name="delete" class="btn"> <i
                                              class="fa fa-trash"></i></button></a></div>
                          </div>
                      </td>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $se['IDVIDEO'] ?></td>
                        <td><?php echo $se['TITLEVIDEO'] ?></td>
                        <td><?php echo $se['MOTAVIDEO'] ?></td>
                        <td><?php echo $se['DUONGDAN	'] ?></td>

                    </tr>
                    <?php $stt++;} ?>
                    <!-- </c:forEach> -->


                    <?php }   else { ?>
                    <?php $stt=0; foreach($result as $se){ ?>
                    <tr>


                        <td align="center">
                            <div class="row">
                              <div class="btn-edit"><a href="video.php?edit=<?php echo $se['IDVIDEO'];?>" data-target="#myModaleadd"><button type="button" name="button" class="btn"> <i class="fas fa-edit" ></i></button></a> </div>
                              <div class="btn-del"><a href="video.php?del=<?php echo $se['IDVIDEO'];?>" onclick="if(confirm('Bạn có chắc chắn xóa không?')) return true; else return false;"><button type="button" name="button" class="btn"> <i class="fa fa-trash" ></i></button></a></div>
                            </div>
                        </td>

                        <td><?php echo $stt ?></td>
                        <td><?php echo $se['IDVIDEO'] ?></td>
                        <td><?php echo $se['TITLEVIDEO'] ?></td>
                        <td><?php echo $se['MOTAVIDEO'] ?></td>
                        <td>
                          <div class="row">
                            <div class="col-12">
                              <video src="video/<?php echo $se['DUONGDAN'] ?>"  height="100px" width="150px" controls></video>
                            </div>
                            <div class="col-12">
                              <a href=""><?php echo $se['DUONGDAN'] ?></a>
                            </div>
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
                     echo '<li class="page-item btn-item"> <a style="height:38px;" class="page-link" href="tintuc.php?page='.($current_page-1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> </li>';
             }
             // Lặp khoảng giữa
             for ($i = 1; $i <= $total_page; $i++){
                 // Nếu là trang hiện tại thì hiển thị thẻ span
                 // ngược lại hiển thị thẻ a
                 if ($i == $current_page){
                     echo ' <li class="page-item btn-active"> <a class="page-link " href="#">'.$i.'</a></li> ';
                 }
                 else{
                     echo ' <li class="page-item"><a class="page-link" href="tintuc.php?page='.$i.'">'.$i.'</a></li> ';
                 }
             }
             // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
             if ($current_page < $total_page && $total_page > 1){
                    echo ' <li class="page-item btn-item"><a style="height:38px;" class="page-link" href="tintuc.php?page='.($current_page+1).'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li> ';
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
                        <h2 style="position:relative; right:250px;">video ADD</h2>
                    </div>
                </div>

                <div class="modal-body">



                    <form action="" method="post"  enctype = "multipart/form-data" style="padding-left: 90px;padding-right: 90px;">

                        <div class="form-group">
                            <div class="row">

                              <div class="col-sm-12">
                                <label>コードビデオ</label>
                                <input name="id" type="text"value="<?php if($ID!=NULL){echo $selist['IDVIDEO']; } else{echo $id;} ?>"class="form-control" readonly required>

                                <label>ビデオタイトル</label>
                                <input name="tieude" type="text"value="<?php if($ID!=NULL){echo $selist['TITLEVIDEO']; } else{echo '';} ?>"class="form-control" required>

                                <label>ビデオコンテンツ</label>
                                <input name="noidung" type="text"value="<?php if($ID!=NULL){echo $selist['MOTAVIDEO']; } else{echo '';} ?>"class="form-control" required>

                                <label>提出日</label>
                                <input name="ngaydang" type="date"value="<?php if($ID!=NULL){echo $selist['NGAYDANG']; } else{echo '';} ?>"class="FORM-control" required>

                                <label>道</label>
                                <input type="file" class="form-control" name = "video" value= "<?php if($ID!=NULL){echo $selist['DUONGDAN'] ;} else{echo '';} ?>">

                              </div>

                        </div>
                      </div>




                        <div class="form-group btn-submit-add" style="padding-left: 100px;margin-top:20px;">
                            <input type="submit" name="<?php if($ID!=NULL){echo 'edit'; } else{echo 'add';} ?>" class="btn " value="SUBMIT">
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
