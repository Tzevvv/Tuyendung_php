<?php 
require 'control.php';  
    session_start();
    if($_SESSION['username'] == null) header('location:login.php');
    else {
        ?>
        <?php 
   

$get_data = new data();
$ID=$_GET['edit'];
$select_us=$get_data->list_user($ID);
foreach($select_us as $select){}

?> 

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <style>
        .login{
            float: right;
            margin-right:30%;
            margin-top:10px;
        }
        .container{
            margin-top:30px;
            margin-left: 25%;
        }
    </style>
</head>
<body>
        <div class="login"> <?php   echo "Hello, " . $_SESSION['username'];
         
         ?> <button type="button" class="btn btn-danger"><a href="logout.php">Thoát</a></button></div>
         <div class="container">
               <div class="row">
                   <div class="col-md-10">
                   <form action="" method="Post" autocomplete="off">
                        <input type="hidden" name="user_id" value="">
                        <label>Password cũ</label></br>
                        <input type="TEXT" name="old_password" value="<?php echo $select['NAME']; ?>" /></br>
                        <label>Password mới</label></br>
                        <input type="TEXT" name="new_password" value="<?php echo $select['PASS']; ?>" /></br>
                        <br><br>
                        <input type="submit" value="Edit" />
                    </form>
                
            
            </div>
    </div>
            <?php
                if(isset($_POST["update"])){
       
								
								if(empty($_POST["danhmuc"])) echo "<script> alert('Not data on name') </script>";
								else {
                                     
									
									$dk_tintuc = $get_data->updatedm($_POST['madm'], $_POST['danhmuc'], $select['id']);
									if($dk_tintuc) 
                                    header('location:hienthidanhmuc.php');
									
									else 
										echo "<script> alert('not sucessful')</script>";
								}
							}
    
            ?>
                    </div>
             </div>
         </div>
         
<?php        
     }
?>


</body>
</html>