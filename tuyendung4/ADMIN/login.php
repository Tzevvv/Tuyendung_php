<?php
include('control.php');
$get_data=new data();//gọi đến class
$select=$get_data->max_uid();//gọi đến function.
foreach($select as $se)
{}
 ?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="css2\login.css" rel="stylesheet" type="text/css"/>
        <title>Login Form</title>
    </head>
    <body>
        <div id="logreg-forms">

             <!--//??ng nh?p-->
            <form class="form-signin"  method="post" >
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>



                <input name="user"  type="text" id="inputEmail" class="form-control" placeholder="Username" required="" autofocus="">
                <input name="pass"  type="password" id="inputPassword" class="form-control" placeholder="Password" required="">

                <div class="form-group form-check">
                    <input name="remember" value="1" type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>

                <button class="btn btn-success btn-block" name="ok" type="submit" style="background-color: black ;color: white;width: 380px; height: 50px ;padding-bottom: 10px;"><i class="fas fa-sign-in-alt"></i> Sign in</button>
                <hr>
                <button class="btn btn-primary btn-block" type="button" id="btn-signup" style="background-color: gray ;color: white;width: 380px; height: 50px ;padding-bottom: 10px;"><i class="fas fa-user-plus"></i> Sign up New Account</button>


               <!--thông báo-->
                <div class="h3 mb-3 font-weight-normal" style="text-align:center">

                </div>
            </form>
            <?php
            if(isset($_POST['ok'])){
                $dk = $get_data->dangnhap($_POST['user'], $_POST['pass']);
              
            }
             ?>


            <!--//??ng ký-->
            <form action="" method="post" class="form-signup" >
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign up</h1>

                <input name="username" type="text" id="user-name" class="form-control" placeholder="Username" required="" autofocus="">
                <input name="password" type="password" id="user-name" class="form-control" placeholder="Password" required="" autofocus="">
                <input name="repass" type="password" id="user-name" class="form-control" placeholder="Nhập lại Password" required="" autofocus="">
                <input name="hoten" type="text" id="user-name" class="form-control" placeholder="Hoten" required="" autofocus="">
                <input name="phone" type="text" id="user-name" class="form-control" placeholder="Phone" required="" autofocus="">
                <input name="email" type="email" id="user-name" class="form-control" placeholder="Email" required="" autofocus="">
                <input name="diachi" type="text" id="user-name" class="form-control" placeholder="Dia chi" required="" autofocus="">
                <button class="btn btn-primary btn-block" name="ok2" type="submit"style="background-color: black ;color: white;width: 380px; height: 50px ;padding-bottom: 10px;"><i class="fas fa-user-plus" > </i> Sign Up</button>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
            </form>

            <?php
            if(isset($_POST['ok2'])){
                $PHANQUYEN=2;

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


                if ($_POST['password']!=$_POST['repass']) {
                  $message = "Password nhập lại không đúng";
                  echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else {
                  $dk = $get_data->dangky($se['max'],$_POST['username'], $_POST['password'],$PHANQUYEN);
                  $dk = $get_data->insert_khachhang($id,$_POST['hoten'], $_POST['phone'], $_POST['email'], $_POST['diachi'],$se['max']);
                }

            }
             ?>
            <br>

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            function toggleResetPswd(e) {
                e.preventDefault();
                $('#logreg-forms .form-signin').toggle() // display:block or none
                $('#logreg-forms .form-reset').toggle() // display:block or none
            }

            function toggleSignUp(e) {
                e.preventDefault();
                $('#logreg-forms .form-signin').toggle(); // display:block or none
                $('#logreg-forms .form-signup').toggle(); // display:block or none
            }

            $(() => {
                // Login Register Form
                $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
                $('#logreg-forms #cancel_reset').click(toggleResetPswd);
                $('#logreg-forms #btn-signup').click(toggleSignUp);
                $('#logreg-forms #cancel_signup').click(toggleSignUp);
            })
        </script>
    </body>
</html>
