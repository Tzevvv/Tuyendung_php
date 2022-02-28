<?php
include('connect.php');
class data{


  public function kiemtraidvideo($idvideo,$user){
        global $conn;
        $sql = "SELECT * FROM users WHERE name = '$user' and MAVIDEO='$idvideo' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
           header("Location:video.php");
        }
        else {
           $message = "Sai mã";
           echo "<script type='text/javascript'>alert('$message');</script>";
        }
  }



  public function select_tintuc() {
      global $conn;
      $sql1= "select * from tintuc";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }



  public function select_tintuc_top6() {
      global $conn;
      $sql1= "SELECT  * FROM  tintuc LIMIT 6";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }


  public function select_tintuc_luotxem_year_top5($date) {
      global $conn;
      $sql1= "SELECT * FROM `tintuc`  WHERE YEAR(date(NGAYDANG)) ='$date' GROUP BY LUOTXEM DESC LIMIT 5;";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }


  public function select_tintuc_luotxem_month_top5($date) {
      global $conn;
      $sql1= "SELECT * FROM `tintuc`  WHERE MONTH(date(NGAYDANG)) ='$date' GROUP BY LUOTXEM DESC LIMIT 5;";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }


  public function select_tintuc_luotxem_DAY_top5($date) {
      global $conn;
      $sql1= "SELECT * FROM `tintuc`  WHERE NGAYDANG ='$date' GROUP BY LUOTXEM DESC LIMIT 5;";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }

  public function select_danhmuc() {
      global $conn;
      $sql1= "select * from danhmuc";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }

  public function select_tintuc_iddm($id) {
      global $conn;
      $sql1= "select * from tintuc WHERE DMID='$id'";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }

  public function select_tintuc_topluotxem() {
      global $conn;
      $sql1= "SELECT * FROM `tintuc` ORDER BY `LUOTXEM` DESC LIMIT 5";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }


  public function select_coment($id) {
      global $conn;
      $sql1= "SELECT * FROM `comment` WHERE TID='$id'";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }


  public function search_tin($timkiem) {
      global $conn;
      $sql1= "SELECT * FROM `tintuc` WHERE TIEUDE LIKE '%$timkiem%';";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }

  public function search_tin_top5($timkiem) {
      global $conn;
      $sql1= "SELECT * FROM `tintuc` WHERE TIEUDE LIKE '%$timkiem%' LIMIT 5";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }




  public function select_video() {
      global $conn;
      $sql1= "select * from video";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }



  public function select_video_top6() {
      global $conn;
      $sql1= "SELECT  * FROM  video LIMIT 6";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }


  //insert---------------------------------------------------
  public function insert_comment($name,$noidung_cm,$tid){
          global $conn;
          $sql = "INSERT INTO `comment`(`name_cm`, `noidung_cm`, `TID`) VALUES  ('$name','$noidung_cm','$tid')";
          $run = mysqli_query($conn,$sql);
          return $run;
          header('location:single.php');

      }





  //update------------------------------------------------------------------
  public function update_luotxem($id){
      global $conn;
      $sql = "UPDATE `tintuc` SET `LUOTXEM`=(SELECT LUOTXEM+1 FROM tintuc WHERE `TID`='$id') WHERE `TID`='$id'";
      $run = mysqli_query($conn,$sql);
      return $run;
  }

  //lisst-------------------------------------------------------------------



  public function list_tintuc($id) {
    global $conn;
    $sql = "select * from tintuc where TID ='$id' ";
    $run = mysqli_query($conn,$sql);
    $data = array();
    while($row = mysqli_fetch_array($run)) {
        $data[]=$row;
    }
    return $data;
}


//tìm kiếm ---------------------------------------------------------------------

}
