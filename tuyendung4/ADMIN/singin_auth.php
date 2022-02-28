
<!-- //xác thực người dùng đã đăng nhập -->
<?php
session_start();
if(!isset($_SESSION["PHANQUYEN"])){
header("Location:login.php");
}

?>
