<?php
include('connect.php');
class data{

  public function dangnhap( $user, $password ){
       global $conn;
       session_start();
         if (isset($user)){

       $user = stripslashes($user);
       $user = mysqli_real_escape_string($conn,$user);
       $password = stripslashes($password);
       $password =  mysqli_real_escape_string($conn,$password);
       if ($user == "" || $password =="") {
            echo "<script> alert('email và password không được để trống!') </script>";
       }else{
         $sql = "select * from users where NAME = '$user' and PASS = '$password' ";
         $query = mysqli_query($conn,$sql) or die(mysql_error());
         $num_rows = mysqli_fetch_array($query);
         if ($num_rows==0) {
              $message ="Đăng nhập k thành công";
              echo "<script type='text/javascript'>alert('$message');</script>";
         }else{

           if ($num_rows['PHANQUYEN']==1) {
             $_SESSION['PHANQUYEN'] = $num_rows['PHANQUYEN'];
             $_SESSION['username'] = $user;
              header("Location:../index.php");
           }
           if ($num_rows['PHANQUYEN']==0) {
             $_SESSION['PHANQUYEN'] = $num_rows['PHANQUYEN'];
             $_SESSION['username'] = $user;
              header("Location:../index.php");
           }
           if ($num_rows['PHANQUYEN']==2) {
             $_SESSION['PHANQUYEN'] = $num_rows['PHANQUYEN'];
             $_SESSION['username'] = $user;
             header("Location:../index.php");
           }
         }
       }
     }
   }




// nhân viên
   public function nvid_update_hoadon($id1,$id2) {
           global $conn;
           $sql = "UPDATE `hoadon` SET `NVID`= '$id1' WHERE idhoadon=(SELECT idhoadon FROM hoadon WHERE NVID=(SELECT NVID FROM nhanvien WHERE ID='$id2'));";
           $run = mysqli_query($conn,$sql);
           return $run;
         }

   public function nvid_update_visa($id1,$id2) {
          global $conn;
          $sql = "UPDATE `visa` SET `NVID`= '$id1' WHERE ID=(SELECT ID FROM visa WHERE NVID=(SELECT NVID FROM nhanvien WHERE ID='$id2'));";
          $run = mysqli_query($conn,$sql);
          return $run;
       }

   public function nvid_update_visa2($id1,$id2) {
              global $conn;
              $sql = "UPDATE `visa` SET `NV2ID`= '$id1' WHERE ID=(SELECT ID FROM visa WHERE NVID=(SELECT NVID FROM nhanvien WHERE ID='$id2'));";
              $run = mysqli_query($conn,$sql);
              return $run;
           }




   //  public function nvid_update_visanv1($id1,$id2) {
   //         global $conn;
   //         $sql = "UPDATE `khachhang` SET NVID= '$id1' WHERE ID=(SELECT ID FROM khachhang WHERE NVID=(SELECT NVID FROM nhanvien WHERE ID='$id2'));";
   //         $run = mysqli_query($conn,$sql);
   //         return $run;
   //       }
   //
   // public function nvid_update_visanv2($id1,$id2) {
   //        global $conn;
   //        $sql = "UPDATE `khachhang` SET NV2ID= '$id1' WHERE ID=(SELECT ID FROM khachhang WHERE NVID=(SELECT NVID FROM nhanvien WHERE ID='$id2'));";
   //        $run = mysqli_query($conn,$sql);
   //        return $run;
   //      }











        public function nvid_update_visanv1($id1,$id2) {
                   global $conn;
                   $query="SELECT ID FROM visa WHERE NVID=(SELECT NVID FROM nhanvien WHERE ID='$id2')";
                   $result = mysqli_query($conn,$query);

                   // while ($row = mysqli_fetch_array($result)) {
                   //     echo "<script type='text/javascript'>alert('$row[0],$row[1];');</script>";
                   // }

                    while ($row = mysqli_fetch_array($result)) {
                      $sql = "UPDATE `visa` SET NVID= '$id1' WHERE ID=($row[0]);";
                      $run = mysqli_query($conn,$sql);
                      // echo "<script type='text/javascript'>alert('$row[0];');</script>";
                    }
                   return $run;

                 }

             public function nvid_update_visanv2($id1,$id2) {
                    global $conn;
                    $query="SELECT ID FROM visa WHERE NV2ID=(SELECT NVID FROM nhanvien WHERE ID='$id2')";
                    $result = mysqli_query($conn,$query);

                    // while ($row = mysqli_fetch_array($result)) {
                    //     echo "<script type='text/javascript'>alert('$row[0],$row[1];');</script>";
                    // }

                     while ($row = mysqli_fetch_array($result)) {
                       $sql = "UPDATE `visa` SET NV2ID= '$id1' WHERE ID=($row[0]);";
                       $run = mysqli_query($conn,$sql);
                       // echo "<script type='text/javascript'>alert('$row[0];');</script>";
                     }
                    // return $run;

                  }









//nhanvien
   public function khid_update_visa($id1,$id2) {
       global $conn;
       $sql = "UPDATE `visa` SET VISAID= '$id1',KHID='$id1' WHERE ID=(SELECT ID FROM visa WHERE khID=(SELECT KHID FROM khachhang WHERE ID='$id2'));";
       $run = mysqli_query($conn,$sql);
       return $run;
     }

     public function khid_update_hoadon($id1,$id2) {
         global $conn;
         $sql = "UPDATE `hoadon` SET IDHOSO='$id1' WHERE idhoadon=(SELECT KHID FROM khachhang WHERE ID='$id2');";
         $run = mysqli_query($conn,$sql);
         return $run;
       }

//visa
     public function visaid_update_hoadon($id1,$id2) {
        global $conn;
        $sql = "UPDATE `hoadon` SET IDHOSO='$id1' WHERE idhoadon=(SELECT idhoadon FROM hoadon WHERE IDHOSO=(SELECT VISAID FROM visa WHERE ID='$id2'));";
        $run = mysqli_query($conn,$sql);
        return $run;
      }




// Bắt lỗi--------------------------------------------
public function batloi_visa_id($id){
      global $conn;
      $sql = "SELECT * FROM khachhang WHERE KHID= '$id' ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) <= 0){
        $message = "Mã khách không tồn tại bạn vui lòng nhập lại !";
        echo "<script type='text/javascript'>alert('$message');</script>";
        return $result;
      }
      return $result;
}

public function batloi_hoadon_idvisa($id){
      global $conn;
      $sql = "SELECT * FROM visa WHERE VISAID = '$id' ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) <= 0){
        $message = "Mã visa không tồn tại bạn vui lòng nhập lại !";
        echo "<script type='text/javascript'>alert('$message');</script>";
        return $result;
      }
      return $result;
}

public function batloi_visa_idnv($id,$nv){
      global $conn;
      $sql = "SELECT * FROM nhanvien WHERE NVID = '$id' ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) <= 0){
        $message = "Mã nhân viên ".$nv." không tồn tại bạn vui lòng nhập lại !";
        echo "<script type='text/javascript'>alert('$message');</script>";
        return $result;
      }
      return $result;
}


public function batloi_hoadon_idnv($id){
      global $conn;
      $sql = "SELECT * FROM nhanvien WHERE NVID = '$id' ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) <= 0){
        $message = "Mã nhân viên không tồn tại bạn vui lòng nhập lại !";
        echo "<script type='text/javascript'>alert('$message');</script>";
        return $result;
      }
      return $result;
}




  //select-------------------------------------------------------------------
  public function select_khachhang(){
    global $conn;
    $sql="SELECT * FROM users INNER JOIN khachhang ON users.USERID=khachhang.USERID ";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }

  public function select_nhanvien() {
      global $conn;
      $sql= "SELECT * FROM users INNER JOIN nhanvien ON users.USERID=nhanvien.USERID ";
      $run=mysqli_query($conn,$sql);
      $data=array();
      while ($row=mysqli_fetch_array($run)) {
        $data[]=$row;
      }
      return $data;
  }

  public function select_nhanvien_ID_Quyen($id) {
      global $conn;
      $sql= "SELECT * FROM `nhanvien` WHERE USERID=(SELECT USERID FROM users WHERE NAME='$id');";
      $run=mysqli_query($conn,$sql);
      $data=array();
      while ($row=mysqli_fetch_array($run)) {
        $data[]=$row;
      }
      return $data;
  }

  public function select_loaivissa(){
    global $conn;
    $sql="SELECT * FROM `loaivisa` ";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }

  public function select_lawyer() {
      global $conn;
      $sql1= "select * from luatsu";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
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

  public function select_tag() {
      global $conn;
      $sql1= "select * from tag";
      $run = mysqli_query($conn,$sql1);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }




  public function select_thongke(){
    global $conn;
    $sql="SELECT * FROM 'hoadon' ";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }

  public function select_hoadon(){
    global $conn;
    $sql="SELECT * FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID GROUP BY NVID";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }

  public function select_hoadon_nvquyen($id){
    global $conn;
    $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID  WHERE hoadon.NVID=nhanvien.NVID and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }



























  public function select_hoadon_nhanvien(){
    global $conn;
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN khachhang ON hoadon.KHID=khachhang.KHID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }

  public function select_hoadon_nhanvien_nvquyen($id){
    global $conn;
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID WHERE nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }

  public function select_hoso_hodon(){
    global $conn;
    $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }
  public function select_hoso(){
    global $conn;
    $sql="SELECT * FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }

  public function select_hoso_nhanvien_nvquyen($id){
    global $conn;
    $sql="SELECT *, (SELECT NAMENV from nhanvien WHERE NVID=NV2ID) as NAMENV2 FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  INNER JOIN users ON users.USERID=khachhang.USERID WHERE nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }


  //INSERT-------------------------------------------------------------------
  public function dangky($uid, $user , $password ,$PHANQUYEN){
        global $conn;
        $sql = "SELECT * FROM users WHERE name = '$user' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
          $message = "Tài khoản đã tồn tại";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else {
          $sql = "INSERT INTO `users`( `USERID`, `NAME`, `PASS`, `PHANQUYEN`,`MAVIDEO`) VALUES ('$uid','$user','$password','$PHANQUYEN','0')";
          $run = mysqli_query($conn,$sql);
          $message = "Đăng ký thành công";
          echo "<script type='text/javascript'>alert('$message');</script>";
           return $run;

        }
  }


  public function dangky_khach($uid, $user , $password ,$PHANQUYEN){
        global $conn;
        $sql = "SELECT * FROM users WHERE name = '$user' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
          $message = "Tài khoản đã tồn tại";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else {
          $length = 6;
          $randomm= substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
          ceil($length/strlen($x)) )),1,$length);

            echo "<script type='text/javascript'>alert('$randomm');</script>";

          $sql = "INSERT INTO `users`( `USERID`, `NAME`, `PASS`, `PHANQUYEN`,`MAVIDEO`) VALUES ('$uid','$user','$password','$PHANQUYEN','$randomm')";
          $run = mysqli_query($conn,$sql);
          // $message = "Đăng ký thành công";
          // echo "<script type='text/javascript'>alert('$message');</script>";
           return $run;
           header("Location:login.php");
        }
  }




  public function insert_khachhang($id,$tenkhach,$diachi, $email, $phone,$uid,$gioitinh,$bangcap,$langluc,$nguyenvong,$trangthaiviec,$quoctich,$congtyxin,$ngaylap){
        global $conn;
        // $sql = "SELECT * FROM khachhang WHERE USERID = '$uid' ";
        // $result = mysqli_query($conn, $sql);
        // if (mysqli_num_rows($result) > 0){
        //
        // }
        // else {
          $sql = "SELECT * FROM  `khachhang` WHERE `KHID` = '$id' ";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0){
            $message = "Mã khách đã tồn tại";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else {
            $sql = "INSERT INTO `khachhang`( `KHID`, `NAMEKH`, `PHONEKH`, `EMAIL`, `DIACHI`, `USERID`, `gioitinh`, `bangcap`, `nangluc`, `nguyenvong`, `trangthaiviec`, `quoctich`, `CONGTYXIN`, `NGAYLAP`)
                    VALUES ('$id','$tenkhach','$phone',' $email','$diachi','$uid','$gioitinh','$bangcap','$langluc','$nguyenvong','$trangthaiviec','$quoctich','$congtyxin','$ngaylap')";
            $run = mysqli_query($conn,$sql);
            return $run;
         }
        // }
}



public function insert_nhanvien($id,$name,$phone,$email,$diachi,$userid,$congty){
  global $conn;

    $sql = "SELECT * FROM  `nhanvien` WHERE `NVID` = '$id' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      $message = "Mã nhân viên đã tồn tại";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else {
              $sql = "insert into nhanvien(NVID,NAMENV,PHONE,EMAIL,DIACHI,USERID,NVCONGTY) values('$id','$name','$phone','$email','$diachi','$userid','$congty')";
              $run = mysqli_query($conn,$sql);
              return $run;
            }
}



  public function insert_loaivisa($lvisaid,$tenvisa){
         global $conn;
          $sql = "INSERT INTO `loaivisa`(`LVISAID`, `TENLOAI`) VALUES ('$lvisaid','$tenvisa')";
          $run = mysqli_query($conn,$sql);
          return $run;
          header("Location:loaivisa.php");
      }

  public function insert_lawyer($maluatsu,$tenluatsu,$sdt,$email){
          global $conn;
          $sql = "INSERT INTO `luatsu`(`LSID`, `NAME`, `PHONE`, `EMAIL`) VALUES ('$maluatsu','$tenluatsu','$sdt','$email')";
          $run = mysqli_query($conn,$sql);
          return $run;
          header('location:luatsu.php');

      }
public function insert_hoadon($idhoadon,$KHID,$NGAYLAP,$NGAYDONGTIEN,$TIEN,$ngaydongtien1,$tien1,$ngaydongtien2,$tien2,$tongtien,$NV,$Mota){
            global $conn;
            $sql = "SELECT * FROM hoadon WHERE  idhoadon= '$idhoadon' ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
              $message = "Mã hóa đơn đã tồn tại!";
              echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else {
              $sql = "SELECT * FROM hoadon WHERE  IDHOSO= '$KHID' ";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0){
                $message = "Hồ sơ khách hàng!";
                echo "<script type='text/javascript'>alert('$message');</script>";
              }
              else {
              $sql = "INSERT INTO `hoadon`(`idhoadon`, `NGAYLAP`, `IDHOSO`, `NGAYDONGTIEN`, `TIEN`, `NGAYDONG2`, `TIEN2`, `NGAYDONG3`, `TIEN3`, `TONGTIEN`,`NVID`,`Motahd`) values('$idhoadon',' $NGAYLAP','$KHID','$NGAYDONGTIEN','$TIEN','$ngaydongtien1','$tien1','$ngaydongtien2','$tien2','$tongtien','$NV','$Mota')";
              $run = mysqli_query($conn,$sql);
              $message = "Thêm mới thành công";
              echo "<script type='text/javascript'>alert('$message');</script>";
               return $run;
               header("Location:hoadon.php");
            }
          }
}

public function update_hoadon($id_kh,$id,$ngaydongtien1,$tien1,$ngaydongtien2,$tien2,$tongtien,$MOTA,$nv) {
        global $conn;
        $sql = "UPDATE `hoadon` SET `IDHOSO`='$id_kh', `NGAYDONG2`='$ngaydongtien1',`TIEN2`='$tien1',`NGAYDONG3`='$ngaydongtien2',`TIEN3`='$tien2',`TONGTIEN`='$tongtien',`Motahd`='$MOTA',`NVID`='$nv' WHERE idhoadon ='$id'";
        $run = mysqli_query($conn,$sql);
        return $run;
      }
      public function update_user($id,$newpass) {
        global $conn;
        $sql = "UPDATE users SET PASS ='$newpass' WHERE USERID ='$id'";
        $run = mysqli_query($conn,$sql);
        return $run;
}



public function insert_tintuc($idtintuc,$tieude, $ngaydang, $diachi,$mucluong,$anh,$mota,$dmid,$tag,$kinhnghiem,$bangcap,$soluongtuyen,$nganhnghe,$chucvu,$thoigianlamviec,$gioitinh,$dotuoi,$trangthai){
             global $conn;
             $sql = "insert into tintuc values('$idtintuc','$tieude','$ngaydang','$diachi','$mucluong',' $anh','$mota','$dmid','$tag','$kinhnghiem','$bangcap','$soluongtuyen','$nganhnghe','$chucvu','$thoigianlamviec','$gioitinh','$dotuoi','$trangthai')";
             $run = mysqli_query($conn,$sql);
             return $run;

           }

// public function insert_hoso($idhoso,$KHID,$LSID, $NVID, $LVISAID,$NGAYLAP,$tenvisa,$congtyxin,$trangthaivisa,$ngayxinvisa,$ngaycapvisa,$ngayhethanvisa){
//         global $conn;
//         $sql = "INSERT INTO `visa`(`VISAID`, `TENVISA`, `NGAYXIN`, `NGAYCAP`, `NGAYHET`, `CONGTYXIN`, `TRANGTHAI`, `LOAIVISA`, `LSID`, `KHID`, `NVID`, `NGAYLAP`)  VALUES('$idhoso','$tenvisa','$ngayxinvisa','$ngaycapvisa','$ngayhethanvisa','$congtyxin','$trangthaivisa','$LVISAID','$LSID','$KHID','$NVID','$NGAYLAP')";
//         $run = mysqli_query($conn,$sql);
//         return $run;
// }


public function insert_hoso($idhoso,$KHID,$LSID, $NV1ID,$NV2ID, $LVISAID,$NGAYLAP,$tenvisa,$congtyxin,$trangthaivisa,$ngayxinvisa,$ngaycapvisa,$ngayhethanvisa,$name_file,$mota){
      global $conn;
      $sql = "SELECT * FROM visa WHERE KHID = '$KHID' ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        $message = "Hồ sơ khách hàng đã được lập!";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
      else {
        $sql = "INSERT INTO `visa`(`VISAID`, `TENVISA`, `NGAYXIN`, `NGAYCAP`, `NGAYHET`, `CONGTYXIN`, `TRANGTHAI`, `LOAIVISA`, `LSID`, `KHID`, `NVID`, `NV2ID`, `NGAYLAP`, `name_file`, `Mota`)
        VALUES('$idhoso','$tenvisa','$ngayxinvisa','$ngaycapvisa','$ngayhethanvisa','$congtyxin','$trangthaivisa','$LVISAID','$LSID','$KHID','$NV1ID','$NV2ID','$NGAYLAP','$name_file','$mota')";
        $run = mysqli_query($conn,$sql);
        $message = "Thêm mới thành công";
        echo "<script type='text/javascript'>alert('$message');</script>";
        return $run;
        header("Location:visa.php");
      }
}






  //lisst-------------------------------------------------------------------


  public function list_khachhang($id) {
      global $conn;
      $sql = "select * from `khachhang` WHERE `khid`='$id'";
      $run = mysqli_query($conn,$sql);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }
  public function list_user() {
    global $conn;
    $sql = "select * from users";
    $run = mysqli_query($conn,$sql);
    $data = array();
    while($row = mysqli_fetch_array($run)) {
        $data[]=$row;
    }
    return $data;
}

  public function list_loaivisa($id) {
      global $conn;
      $sql = "SELECT * FROM `loaivisa`  WHERE `LVISAID`='$id'";
      $run = mysqli_query($conn,$sql);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }

  public function list_lawyer($id) {
      global $conn;
      $sql = "select * from luatsu where LSID ='$id' ";
      $run = mysqli_query($conn,$sql);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }
  public function list_nhanvien($id) {
      global $conn;
      $sql = "select * from nhanvien where NVID ='$id' ";
      $run = mysqli_query($conn,$sql);
      $data = array();
      while($row = mysqli_fetch_array($run)) {
          $data[]=$row;
      }
      return $data;
  }

  public function list_thongke($id) {
    global $conn;
    $sql = "SELECT * FROM `hoadon`  WHERE `idhoadon`='$id'";
    $run = mysqli_query($conn,$sql);
    $data = array();
    while($row = mysqli_fetch_array($run)) {
        $data[]=$row;
    }
    return $data;
  }

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

public function list_hoadon($id) {
  global $conn;
  $sql = "select * from hoadon where idhoadon ='$id' ";
  $run = mysqli_query($conn,$sql);
  $data = array();
  while($row = mysqli_fetch_array($run)) {
      $data[]=$row;
  }
  return $data;
}



public function list_hoso($id) {
  global $conn;
  $sql = "select * from visa where KHID='$id' ";
  $run = mysqli_query($conn,$sql);
  $data = array();
  while($row = mysqli_fetch_array($run)) {
      $data[]=$row;
  }
  return $data;
}




public function update_tintuc($id,$tieude,$ngaydang,$diachi,$mucluong,$anh,$mota,$dmid) {
    global $conn;

    $sql = "UPDATE tintuc SET TIEUDE='$tieude',NGAYDANG ='$ngaydang',DIACHI= '$diachi', MUCLUONG = '$mucluong' , DUONGDAN ='$anh', MOTA ='$mota', DMID ='$dmid' WHERE   TID ='$id'";
    $run = mysqli_query($conn,$sql);
    return $run;
}
public function update_tintuc1($id,$tieude,$ngaydang,$diachi,$mucluong,$mota,$dmid) {
  global $conn;

  $sql = "UPDATE tintuc SET TIEUDE='$tieude',NGAYDANG ='$ngaydang',DIACHI= '$diachi', MUCLUONG = '$mucluong' , MOTA ='$mota', DMID ='$dmid' WHERE   TID ='$id'";
  $run = mysqli_query($conn,$sql);
  return $run;
}






  //UPDATE-------------------------------------------------------------------


  public function update_loaivisa($lvisaid,$tenvisa){
      global $conn;
      $sql = "UPDATE `loaivisa` SET `TENLOAI`='$tenvisa' WHERE `LVISAID`='$lvisaid'";
      $run = mysqli_query($conn,$sql);
      return $run;
  }

  public function update_nhanvien($name,$phone,$email,$diachi,$idd,$congty,$id_edt) {
      global $conn;
      $sql = "SELECT * FROM  `nhanvien` WHERE `NVID` = '$idd' ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        $message = "Mã visa đã tồn tại";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
      else {
          $sql = "UPDATE `nhanvien` SET `NAMENV`='$name',`PHONE`='$phone',`EMAIL`='$email',`DIACHI`='$diachi' ,`NVCONGTY`='$congty',`NVID`='$idd' WHERE `ID`='$id_edt'";
          $run = mysqli_query($conn,$sql);
          return $run;
        }

  }

  public function update_khachhang($id, $tenkhach, $diachi, $email, $phone ,$gioitinh, $bangcap, $nangluc, $nguyenvong, $trangthaiviec, $quoctich,$congtyxin,$id_edt){
      global $conn;

      // $sql = "SELECT * FROM  `khachhang` WHERE `KHID` = '$id' ";
      // $result = mysqli_query($conn, $sql);
      // if (mysqli_num_rows($result) > 0){
      //   $message = "Mã khách đã tồn tại";
      //   echo "<script type='text/javascript'>alert('$message');</script>";
      // }

        $sql = "UPDATE `khachhang` SET `NAMEKH`='tenkhach',`PHONEKH`='$phone',`EMAIL`='$email',`DIACHI`='$diachi',`gioitinh`='$gioitinh',`bangcap`='$bangcap',`nangluc`='$nangluc',`nguyenvong`='$nguyenvong',`trangthaiviec`='$trangthaiviec',`quoctich`='$quoctich',`CONGTYXIN`='$congtyxin',`KHID`='$id' WHERE `ID`='$id_edt'";
        $run = mysqli_query($conn,$sql);
        return $run;

  }



  public function update_lawyer($id,$ten,$sdt,$email) {
      global $conn;
      $sql = "update luatsu Set NAME ='$ten',PHONE='$sdt',EMAIL='$email' where LSID ='$id'";
      $run = mysqli_query($conn,$sql);
      return $run;
  }

  public function update_hoso($idhoso,$KHID,$LSID, $NV1ID,$NV2ID, $LVISAID,$NGAYLAP,$tenvisa,$congtyxin,$trangthaivisa,$ngayxinvisa,$ngaycapvisa,$ngayhethanvisa,$name_file,$mota,$id_edt) {
      global $conn;
      $sql = "UPDATE `visa` SET `TENVISA`='$tenvisa',`NGAYXIN`='$ngayxinvisa',`NGAYCAP`='$ngaycapvisa',`NGAYHET`='$ngayhethanvisa',`CONGTYXIN`='$congtyxin',`TRANGTHAI`='$trangthaivisa',`LOAIVISA`='$LVISAID',`LSID`='$LSID',`KHID`='$KHID',`NVID`='$NV1ID',`NV2ID`='$NV2ID',`NGAYLAP`='$NGAYLAP',`name_file`='$name_file',`Mota`='$mota' ,`VISAID`='$idhoso' WHERE `ID`='$id_edt'";
      $run = mysqli_query($conn,$sql);
      return $run;
  }
  public function update_hoso2($idhoso,$KHID,$LSID, $NV1ID,$NV2ID, $LVISAID,$NGAYLAP,$tenvisa,$congtyxin,$trangthaivisa,$ngayxinvisa,$ngaycapvisa,$ngayhethanvisa,$mota,$id_edt) {
      global $conn;
      $sql = "UPDATE `visa` SET `TENVISA`='$tenvisa',`NGAYXIN`='$ngayxinvisa',`NGAYCAP`='$ngaycapvisa',`NGAYHET`='$ngayhethanvisa',`CONGTYXIN`='$congtyxin',`TRANGTHAI`='$trangthaivisa',`LOAIVISA`='$LVISAID',`LSID`='$LSID',`KHID`='$KHID',`NVID`='$NV1ID',`NV2ID`='$NV2ID',`NGAYLAP`='$NGAYLAP',`Mota`='$mota',`VISAID`='$idhoso' WHERE `ID`='$id_edt'";
      $run = mysqli_query($conn,$sql);
      return $run;
  }
  public function delete_tintuc($id) {
      global $conn;
      $sql = "Delete  from tintuc where TID = '$id'";
      $run = mysqli_query($conn,$sql);
      return $run;
      header('location:tintuc.php');

  }


  //delete------------------------------------------------------------------------
  public function delete_khachhang($id) {
      global $conn;
      $sql = "Delete  from khachhang where khid = '$id'";
      $run = mysqli_query($conn,$sql);
      return $run;
}

public function delete_user_khachhang($id) {
    global $conn;
    $sql = "DELETE FROM `users` WHERE USERID=(SELECT USERID FROM khachhang WHERE KHID= '$id')";
    $run = mysqli_query($conn,$sql);
    return $run;
}

public function delete_loaivisa($id) {
    global $conn;
    $sql = "Delete  from `loaivisa` where LVISAID = '$id'";
    $run = mysqli_query($conn,$sql);
    return $run;
}

public function delete_tk($id) {
    global $conn;
    $sql = "Delete from users where NAME = '$id'";
    $run = mysqli_query($conn,$sql);
    return $run;

}

public function delete_nhanvien($id) {
    global $conn;
    $sql = "Delete  from nhanvien where NVID = '$id'";
    $run = mysqli_query($conn,$sql);
    return $run;

}
public function delete_user_nhanvien($id) {
    global $conn;
    $sql = "DELETE FROM `users` WHERE USERID=(SELECT USERID FROM nhanvien WHERE NVID= '$id')";
    $run = mysqli_query($conn,$sql);
    return $run;
}



public function delete_hoadon($id) {
    global $conn;
    $sql = "DELETE FROM `hoadon` WHERE idhoadon='$id'";
    $run = mysqli_query($conn,$sql);
    return $run;

}

public function delete_hoso($id) {
    global $conn;
    $sql = "DELETE FROM `visa` WHERE KHID='$id'";
    $run = mysqli_query($conn,$sql);
    return $run;

}



//tìm kiếm ---------------------------------------------------------------------
public function search_khachhang($name){
  global $conn;
  $sql="SELECT * FROM users INNER JOIN khachhang ON users.USERID=khachhang.USERID  WHERE NAME like'%$name%' or NAMEKH like'%$name%' or DIACHI  like'%$name%' or PHONEKH  like'%$name%' ";
  $run=mysqli_query($conn,$sql);
  $data=array();

  while ($row=mysqli_fetch_array($run)) {
    $data[]=$row;
  }
  return $data;
}

public function search_nhanvien($name){
    global $conn;
    $sql="SELECT * FROM users INNER JOIN nhanvien ON users.USERID=nhanvien.USERID WHERE  NVID  like'%$name%' or PHONE  like'%$name%' ";
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }



public function search_hoadontuden_ten($tu,$den,$name,$nv){
    global $conn;

    if ($tu==null and $tu=="" and $den==null and $den=="" and $name==null and $name=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv'";
    }
    else if ($tu==null and $tu=="" and $den==null and $den=="" and $nv==null  and $nv=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE khachhang.KHID='$name'";
    }
    else if ($nv==null and $nv=="" and $name==null and $name=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.NGAYLAP between'$tu' and '$den'";
    }
    else if ($tu==null and $tu=="" and $den==null and $den=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name'";
    }
    else if ($nv==null and $nv=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  hoadon.idhoso='$name' and hoadon.NGAYLAP between'$tu' and '$den' ";
    }
    else if ($name==null  and $name=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  nhanvien.NVID='$nv' and hoadon.NGAYLAP between'$tu' and '$den' ";
    }
    else {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name'  and  hoadon.NGAYLAP between'$tu' and '$den'";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }


public function search_hoadontuden_ten_idnv($tu,$den,$name,$nv,$id){
    global $conn;

    if ($tu==null and $tu=="" and $den==null and $den=="" and $name==null and $name=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE khachhang.KHID='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($nv==null  and $nv=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  khachhang.KHID='$name' and hoadon.NGAYLAP between'$tu' and '$den'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($name==null  and $name=="") {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  nhanvien.NVID='$nv' and hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";
    }
    else {
      $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name'  and  hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }


  // public function search_hoadontuden_ten_idnv($tu,$den,$name,$nv){
  //     global $conn;
  //
  //     if ($tu==null and $tu=="" and $den==null and $den=="" and $name==null and $name=="") {
  //       $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  //     }
  //     else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
  //       $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.idhoso='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  //     }
  //     else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
  //       $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  //     }
  //     else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
  //       $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and hoadon.idhoso='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  //     }
  //     else if ($nv==null  and $nv=="") {
  //       $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  hoadon.idhoso='$name' and hoadon.NGAYLAP between'$tu' and '$den'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  //     }
  //     else if ($name==null  and $name=="") {
  //       $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  nhanvien.NVID='$nv' and hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";
  //     }
  //     else {
  //       $sql="SELECT * FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and hoadon.idhoso='$name'  and  hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  //     }
  //     $run=mysqli_query($conn,$sql);
  //     $data=array();
  //
  //     while ($row=mysqli_fetch_array($run)) {
  //       $data[]=$row;
  //     }
  //     return $data;
  //   }



  public function sum_hd(){
   global $conn;
   $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID ";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
   return $data;
 }
 public function sum_hd_tong($tu,$den,$name,$nv){
   global $conn;
   if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $name==null  and $name=="") {
     $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv'";
   }
   else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
     $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE khachhang.KHID='$name'";
   }
   else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
     $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.NGAYLAP between'$tu' and '$den'";
   }
   else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
     $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name'";
   }
   else if ($nv==null  and $nv=="") {
     $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  khachhang.KHID='$name' and hoadon.NGAYLAP between'$tu' and '$den' ";
   }
   else if ($name==null  and $name=="") {
     $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  nhanvien.NVID='$nv' and hoadon.NGAYLAP between'$tu' and '$den' ";
   }
   else {
     $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name'  and  hoadon.NGAYLAP between'$tu' and '$den'";
   }
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
   return $data;
 }
public function sum_hd_nvid($id){
  global $conn;
  $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID  WHERE  nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}
public function sum_hd_tong_nvid($tu,$den,$name,$nv,$id){
  global $conn;
  if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $name==null  and $name=="") {
    $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
    $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE khachhang.KHID='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
    $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
    $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($nv==null  and $nv=="") {
    $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  khachhang.KHID='$name' and hoadon.NGAYLAP between'$tu' and '$den'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($name==null  and $name=="") {
    $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  nhanvien.NVID='$nv' and hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";
  }
  else {
    $sql="SELECT sum(hoadon.TONGTIEN) as sum FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and khachhang.KHID='$name'  and  hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }

  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}

public function count_landongtien(){
  global $conn;
  $sql="SELECT (SELECT COUNT(TIEN) FROM hoadon WHERE TIEN > 0)AS tien,(SELECT COUNT(TIEN2) FROM hoadon WHERE TIEN2 > 0)AS tien2,(SELECT COUNT(TIEN3) FROM hoadon WHERE TIEN3 > 0)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}

public function Search_count_landongtien($tu,$den,$name,$nv){
  global $conn;
  if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $name==null  and $name=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv'";
  }
  else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.idhoso='$name'";
  }
  else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tongm FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.NGAYLAP between'$tu' and '$den'";
  }
  else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and hoadon.idhoso='$name'";
  }
  else if ($nv==null  and $nv=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  hoadon.idhoso='$name' and hoadon.NGAYLAP between'$tu' and '$den' ";
  }
  else if ($name==null  and $name=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  nhanvien.NVID='$nv' and hoadon.NGAYLAP between'$tu' and '$den' ";
  }
  else {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and hoadon.idhoso='$name'  and  hoadon.NGAYLAP between'$tu' and '$den'";
  }
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}




public function count_landongtien_nvid($id){
  global $conn;
  $sql="SELECT (SELECT COUNT(TIEN) FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE TIEN > 0 AND nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id'))AS tien,
        (SELECT COUNT(TIEN2) FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE TIEN2 > 0 AND nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id'))AS tien2,
        (SELECT COUNT(TIEN3) FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE TIEN3 > 0 AND nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id'))as tien3,
        (SELECT COUNT(idhoadon) FROM Hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') )AS tong FROM hoadon
       ";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}

public function Search_count_landongtien_nvid($tu,$den,$name,$nv,$id){
  global $conn;
  if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $name==null  and $name=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.idhoso='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tongm FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and hoadon.idhoso='$name' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($nv==null  and $nv=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  hoadon.idhoso='$name' and hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else if ($name==null  and $name=="") {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE  nhanvien.NVID='$nv' and hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  else {
    $sql="SELECT COUNT(TIEN2)AS tien2,COUNT(TIEN3)as tien3,COUNT(idhoadon)AS tong FROM hoadon INNER JOIN visa ON hoadon.IDHOSO=visa.VISAID INNER JOIN nhanvien ON hoadon.NVID=nhanvien.NVID INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID='$nv' and hoadon.idhoso='$name'  and  hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  }
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}

















public function search_doanhthu($tu,$den,$nv,$id){
    global $conn;
    if ($tu==null and $tu=="" and $den==null and $den=="") {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  GROUP BY NVID";
    }
    else if ($nv==null and $nv=="" ) {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONGTIEN between'$tu' and '$den' GROUP BY NVID";
    }
    else {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYDONGTIEN between'$tu' and '$den' GROUP BY NVID";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
}

public function search_doanhthu2($tu,$den,$nv,$id){
    global $conn;
    if ($tu==null and $tu=="" and $den==null and $den=="") {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN2)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  GROUP BY NVID";
    }
    else if ($nv==null and $nv=="" ) {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN2)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONG2 between'$tu' and '$den' GROUP BY NVID";
    }
    else {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN2)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYDONG2 between'$tu' and '$den' GROUP BY NVID";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
}
public function search_doanhthu3($tu,$den,$nv,$id){
    global $conn;
    if ($tu==null and $tu=="" and $den==null and $den=="") {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN3)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  GROUP BY NVID";
    }
    else if ($nv==null and $nv=="" ) {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN3)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONG3 between'$tu' and '$den' GROUP BY NVID";
    }
    else {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN3)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID='$id' and hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYDONG3 between'$tu' and '$den' GROUP BY NVID";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
}



public function sum_doanhthu_search($tu,$den,$nv,$id){
  global $conn;
  if ($tu==null and $tu=="" and $den==null and $den=="") {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV ,SUM(hoadon.TIEN)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'";
  }
  else if ($nv==null and $nv=="" ) {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV ,SUM(hoadon.TIEN)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONGTIEN between'$tu' and '$den'";
  }
  else {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN)AS sum FROM hoadon,nhanvien  WHERE   hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYDONGTIEN between'$tu' and '$den' ";
  }
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {
    $data[]=$row;
  }
  return $data;
}

public function sum_doanhthu_search2($tu,$den,$nv,$id){
  global $conn;
  if ($tu==null and $tu=="" and $den==null and $den=="") {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV ,SUM(hoadon.TIEN2)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'";
  }
  else if ($nv==null and $nv=="" ) {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV ,SUM(hoadon.TIEN2)AS sum FROM hoadon,nhanvien  WHERE   hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONG2 between'$tu' and '$den'";
  }
  else {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN2)AS sum FROM hoadon,nhanvien  WHERE  hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYDONG2 between'$tu' and '$den' ";
  }
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {
    $data[]=$row;
  }
  return $data;
}

public function sum_doanhthu_search3($tu,$den,$nv,$id){
  global $conn;
  if ($tu==null and $tu=="" and $den==null and $den=="") {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV ,SUM(hoadon.TIEN3)AS sum FROM hoadon,nhanvien  WHERE   hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'";
  }
  else if ($nv==null and $nv=="" ) {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV ,SUM(hoadon.TIEN3)AS sum FROM hoadon,nhanvien  WHERE   hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONG3 between'$tu' and '$den'";
  }
  else {
    $sql="SELECT hoadon.NVID, nhanvien.NAMENV, SUM(hoadon.TIEN3)AS sum FROM hoadon,nhanvien  WHERE   hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYDONG3 between'$tu' and '$den' ";
  }
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {
    $data[]=$row;
  }
  return $data;
}














public function search_doanhthu_nvid($tu,$den,$nv,$id,$id2){
  global $conn;
  $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN)AS sum FROM hoadon,nhanvien  WHERE nhanvien.NVID='$id2' and hoadon.NVID=nhanvien.NVID and hoadon.NGAYDONGTIEN between '$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";

  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}

public function search_doanhthu_nvid2($tu,$den,$nv,$id,$id2){
  global $conn;
  $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN2)AS sum FROM hoadon,nhanvien  WHERE nhanvien.NVID='$id2' and hoadon.NVID=nhanvien.NVID and hoadon.NGAYDONG2 between '$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";

  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}

public function search_doanhthu_nvid3($tu,$den,$nv,$id,$id2){
  global $conn;
  $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TIEN3)AS sum FROM hoadon,nhanvien  WHERE nhanvien.NVID='$id2' and hoadon.NVID=nhanvien.NVID and hoadon.NGAYDONG3 between '$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";

  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}




public function sum_doanhthu_tk_nvid($tu,$den,$nv,$id){
  global $conn;
  $sql="SELECT SUM(hoadon.TIEN) as sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONGTIEN between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}
public function sum_doanhthu_tk_nvid2($tu,$den,$nv,$id){
  global $conn;
  $sql="SELECT SUM(hoadon.TIEN2) as sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONG2 between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}
public function sum_doanhthu_tk_nvid3($tu,$den,$nv,$id){
  global $conn;
  $sql="SELECT SUM(hoadon.TIEN3) as sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and hoadon.NGAYDONG3 between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}

















public function sum_doanhthu_tung_nv($id){
    global $conn;

      $sql="SELECT SUM(hoadon.TONGTIEN)AS sum FROM hoadon WHERE NVID='$id' GROUP BY NVID;";
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
}








public function sum_doanhthu_tk($tu,$den,$nv){
    global $conn;
    if ($tu==null and $tu=="" and $den==null and $den=="") {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TONGTIEN)AS sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  GROUP BY NVID";
    }
    else if ($nv==null and $nv=="" ) {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TONGTIEN)AS sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and hoadon.NGAYLAP between'$tu' and '$den' GROUP BY NVID";
    }
    else {
      $sql="SELECT hoadon.NVID, nhanvien.NAMENV,SUM(hoadon.TONGTIEN)AS sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYLAP between'$tu' and '$den' GROUP BY NVID";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
}









// public function sum_doanhthu_tk_nvid($tu,$den,$nv,$id){
//   global $conn;
//   if ($tu==null and $tu=="" and $den==null and $den=="") {
//     $sql="SELECT SUM(hoadon.TONGTIEN) as sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')  GROUP BY NVID";
//   }
//   else if ($nv==null and $nv=="" ) {
//     $sql="SELECT SUM(hoadon.TONGTIEN) as sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') GROUP BY NVID";
//   }
//   else {
//     $sql="SELECT SUM(hoadon.TONGTIEN) as sum FROM FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID  and nhanvien.NVID='$nv'  and  hoadon.NGAYLAP between'$tu' and '$den' and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') GROUP BY NVID";
//   }
//   $run=mysqli_query($conn,$sql);
//   $data=array();
//   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
//   return $data;
// }



public function sum_doanhthu(){
 global $conn;
 $sql="SELECT SUM(hoadon.TONGTIEN) as sum FROM hoadon,nhanvien WHERE hoadon.NVID=nhanvien.NVID";
 $run=mysqli_query($conn,$sql);
 $data=array();
 while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
 return $data;
}
public function sum_doanhthu_nvid($id){
 global $conn;
 $sql="SELECT SUM(hoadon.TONGTIEN) as sum FROM hoadon,nhanvien  WHERE hoadon.NVID=nhanvien.NVID and  nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";
 $run=mysqli_query($conn,$sql);
 $data=array();
 while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
 return $data;
}










public function count_trangthaiviec(){
  global $conn;
  $sql="SELECT  COUNT(trangthaiviec) AS tong,
       (SELECT COUNT(trangthaiviec) FROM khachhang WHERE trangthaiviec='面接まだ') AS chuapv,
       (SELECT COUNT(trangthaiviec) FROM khachhang WHERE trangthaiviec='結果待ち') AS chokq,
       (SELECT COUNT(trangthaiviec) FROM khachhang WHERE trangthaiviec='内定した') AS chungtuyen,
       (SELECT COUNT(trangthaiviec) FROM khachhang WHERE trangthaiviec='キャンセル') AS huyyc
       FROM `khachhang`";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {
    $data[]=$row;
  }
  return $data;
}

public function search_trangthaichuapv(){
  global $conn;
  $sql="SELECT * FROM khachhang  WHERE trangthaiviec='面接まだ'";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {
    $data[]=$row;
  }
  return $data;
}

  public function search_trangthaidoikq(){
    global $conn;
    $sql="SELECT * FROM khachhang  WHERE trangthaiviec='結果待ち'";
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }
  public function search_trangthaithanhcong(){
    global $conn;
    $sql="SELECT * FROM khachhang  WHERE trangthaiviec='内定した'";
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }
  public function search_trangthaihuy(){
    global $conn;
    $sql="SELECT * FROM khachhang  WHERE trangthaiviec='キャンセル'";
    $run=mysqli_query($conn,$sql);
    $data=array();
    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }






public function search_hoso($tu,$den,$name,$nv){
    global $conn;
    if ($tu==null and $tu=="" and $den==null and $den=="" and $name==null and $name=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID WHERE nhanvien.NVID ='$nv' ";
    }
    else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE khachhang.KHID ='$name' ";
    }
    else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID  WHERE  visa.NGAYLAP between '$tu' and '$den'";
    }
    else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID  WHERE khachhang.KHID ='$name' and nhanvien.NVID ='$nv' ";
    }
    else if ($nv==null  and $nv=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE khachhang.KHID ='$name' and visa.NGAYLAP between '$tu' and '$den'";
    }
    else if ($name==null  and $name=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE  visa.NGAYLAP between '$tu' and '$den' and nhanvien.NVID='$nv'";
    }
    else {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE khachhang.KHID ='$name' and nhanvien.NVID ='$nv' and visa.NGAYLAP between '$tu' and '$den'";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }
  //
  // public function search_count_trangthaiviec(){
  //   global $conn;
  //   if ($tu==null and $tu=="" and $den==null and $den=="" and $name==null and $name=="") {
  //     $sql="SELECT  COUNT(khachhang.Trangthai) AS tong,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='面接まだ') AS chuapv,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='結果待ち') AS chokq,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='内定した') AS chungtuyen,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='キャンセル') AS huyyc FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  WHERE nhanvien.NVID ='$nv' ";
  //   }
  //   else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
  //     $sql="SELECT  COUNT(khachhang.Trangthai) AS tong,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='面接まだ') AS chuapv,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='結果待ち') AS chokq,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='内定した') AS chungtuyen,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='キャンセル') AS huyyc FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  WHERE khachhang.KHID ='$name' ";
  //   }
  //   else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
  //     $sql="SELECT  COUNT(khachhang.Trangthai) AS tong,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='面接まだ') AS chuapv,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='結果待ち') AS chokq,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='内定した') AS chungtuyen,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='キャンセル') AS huyyc FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  WHERE  visa.NGAYLAP between '$tu' and '$den'";
  //   }
  //   else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
  //     $sql="SELECT  COUNT(khachhang.Trangthai) AS tong,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='面接まだ') AS chuapv,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='結果待ち') AS chokq,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='内定した') AS chungtuyen,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='キャンセル') AS huyyc FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  WHERE khachhang.KHID ='$name' and nhanvien.NVID ='$nv' ";
  //   }
  //   else if ($nv==null  and $nv=="") {
  //     $sql="SELECT  COUNT(khachhang.Trangthai) AS tong,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='面接まだ') AS chuapv,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='結果待ち') AS chokq,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='内定した') AS chungtuyen,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='キャンセル') AS huyyc FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  WHERE khachhang.KHID ='$name' and visa.NGAYLAP between '$tu' and '$den'";
  //   }
  //   else if ($name==null  and $name=="") {
  //     $sql="SELECT  COUNT(khachhang.Trangthai) AS tong,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='面接まだ') AS chuapv,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='結果待ち') AS chokq,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='内定した') AS chungtuyen,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='キャンセル') AS huyyc FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  WHERE  visa.NGAYLAP between '$tu' and '$den' and nhanvien.NVID='$nv'";
  //   }
  //   else {
  //     $sql="SELECT  COUNT(khachhang.Trangthai) AS tong,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='面接まだ') AS chuapv,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='結果待ち') AS chokq,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='内定した') AS chungtuyen,(SELECT COUNT(Trangthai) FROM khachhang WHERE Trangthai='キャンセル') AS huyyc FROM visa INNER JOIN khachhang ON visa.KHID=khachhang.KHID INNER JOIN nhanvien ON visa.NVID=nhanvien.NVID INNER JOIN loaivisa ON visa.LOAIVISA=loaivisa.LVISAID INNER JOIN luatsu ON visa.LSID=luatsu.LSID  WHERE khachhang.KHID ='$name' and nhanvien.NVID ='$nv' and visa.NGAYLAP between '$tu' and '$den'";
  //   }
  //
  //   $run=mysqli_query($conn,$sql);
  //   $data=array();
  //   while ($row=mysqli_fetch_array($run)) {
  //     $data[]=$row;
  //   }
  //   return $data;
  // }



  public function search_hoso_idnv($tu,$den,$name,$nv,$id){
    global $conn;
    if ($tu==null and $tu=="" and $den==null and $den=="" and $name==null and $name=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE nhanvien.NVID ='$nv'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($tu==null  and  $tu=="" and $den==null  and  $den=="" and $nv==null  and $nv=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID";}
    else if ($nv==null  and $nv=="" and $name==null  and $name=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE  visa.NGAYLAP between '$tu' and '$den'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($tu==null  and  $tu=="" and $den==null  and  $den=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE khachhang.KHID ='$name' and nhanvien.NVID ='$nv'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id') ";
    }
    else if ($nv==null  and $nv=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE khachhang.KHID ='$name' and visa.NGAYLAP between '$tu' and '$den'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else if ($name==null  and $name=="") {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID   WHERE  visa.NGAYLAP between '$tu' and '$den' and nhanvien.NVID='$nv'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    else {
      $sql="SELECT * FROM `visa` INNER JOIN khachhang ON visa.KHID=khachhang.KHID    WHERE khachhang.KHID ='$name' and nhanvien.NVID ='$nv' and visa.NGAYLAP between '$tu' and '$den'  and nhanvien.USERID=(SELECT USERID FROM users WHERE NAME='$id')";
    }
    $run=mysqli_query($conn,$sql);
    $data=array();

    while ($row=mysqli_fetch_array($run)) {
      $data[]=$row;
    }
    return $data;
  }











  // public function search_hosokhachhang($phone, $khachhang){
  //     global $conn;
  //     if ($phone==null and $phone=="") {
  //       $sql="SELECT * FROM `khachhang` WHERE KHID='$khachhang'";
  //     }
  //     else if ($phone==null  and  $phone=="" ) {
  //       $sql="SELECT * FROM `khachhang` WHERE PHONEKH='$phone'";
  //     }
  //     else {
  //       $sql="SELECT * FROM `khachhang` WHERE KHID='$khachhang' and PHONEKH='$phone'";
  //     }
  //     $run=mysqli_query($conn,$sql);
  //     $data=array();
  //
  //     while ($row=mysqli_fetch_array($run)) {
  //       $data[]=$row;
  //     }
  //     return $data;
  //   }

  public function search_hosokhachhang($tu,$den,$name){
      global $conn;

     if ($tu==null  and  $tu=="" and $den==null  and  $den=="" ) {
        $sql="SELECT * FROM `khachhang`   WHERE KHID ='$name' ";
      }
      else if ( $name==null  and $name=="") {
        $sql="SELECT * FROM `khachhang`  WHERE  NGAYLAP between '$tu' and '$den'";
      }

      else {
        $sql="SELECT * FROM `khachhang`   WHERE KHID ='$name'  and NGAYLAP between '$tu' and '$den'";
      }
      $run=mysqli_query($conn,$sql);
      $data=array();

      while ($row=mysqli_fetch_array($run)) {
        $data[]=$row;
      }
      return $data;
    }




































 public function max_uid(){
   global $conn;
   $sql="SELECT MAX(USERID+1) as max FROM `users`";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
   return $data;
 }

 public function max_khachhang_id(){
   global $conn;
   $sql="SELECT max(right(KHID,5)) as max FROM `khachhang`";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
   return $data;
 }

 public function max_nhanvien_id(){
   global $conn;
   $sql="SELECT max(right(NVID,5)) as max FROM `nhanvien`";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
   return $data;
 }

 public function max_luatsu_id(){
   global $conn;
   $sql="SELECT max(right(LSID,5)) as max FROM `luatsu`";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
   return $data;
 }

 public function max_hoadon_id(){
   global $conn;
   $sql="SELECT max(right(idhoadon,5)) as max FROM `hoadon`";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}

   return $data;
 }


 public function max_hoso_id(){
   global $conn;
   $sql="SELECT max(right(VISAID,5)) as max FROM `visa`";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}

   return $data;
 }

 public function max_tintuc_id(){
   global $conn;
   $sql="SELECT max(right(tid,5)) as max FROM `tintuc`";
   $run=mysqli_query($conn,$sql);
   $data=array();
   while ($row=mysqli_fetch_array($run)) {$data[]=$row;}

   return $data;
 }

 //upload-------------------------------------------
 public function upload($tmp,$name){
   $up = move_uploaded_file($tmp , $name);
   return $up;

 }



//vi_deo
public function max_video(){
  global $conn;
  $sql="SELECT MAX(IDVIDEO+1) as max FROM `video`";
  $run=mysqli_query($conn,$sql);
  $data=array();
  while ($row=mysqli_fetch_array($run)) {$data[]=$row;}
  return $data;
}
 public function hienthi(){
     global $conn;
     $sql = "select * from video";
     $run = mysqli_query($conn, $sql);

     $databl = array();
     if($run) {
         while($rows = mysqli_fetch_array($run))
         {
             $databl[] = $rows;
         }
         return $databl;
      }

 }
 public function inser_video($id,$ngaydang,$title,$mota,$duongdan){
   global $conn;
    $sql = "INSERT INTO video VALUES ('$id','$ngaydang','$title','$mota','$duongdan')";
    $run = mysqli_query($conn,$sql);
    return $run;

 }

 public function update_video($id,$ngaydang,$title,$mota){
         global $conn;
         $sql = "UPDATE `video` SET `TITLEVIDEO`='$title',`MOTAVIDEO`='$mota' WHERE IDVIDEO ='$id'";
         $run = mysqli_query($conn,$sql);
         return $run;
       }

   public function upload_video($tmp,$name){
     $up = move_uploaded_file($tmp , $name);
     return $up;

   }

   public function delete_video($id) {
       global $conn;
       $sql = "Delete  from video where IDVIDEO = '$id'";
       $run = mysqli_query($conn,$sql);
       return $run;
       header('location:video.php');

   }

   public function list_video($id) {
     global $conn;
     $sql = "select * from video where IDVIDEO = '$id' ";
     $run = mysqli_query($conn,$sql);
     $data = array();
     while($row = mysqli_fetch_array($run)) {
         $data[]=$row;
     }
     return $data;
 }



}
