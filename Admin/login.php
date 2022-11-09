<?php
include('config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login-Mero Design</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <div class="login">
<h1 class="text-center">Login</h1><br>
<?php
include('config/session.php')
?>
<!-- form-start -->
<form action="" method="post">
<label for="">Username</label>
<input type="text" name="user_name" class="form-control-login" placeholder="Username.."><br><br>
<label for="">Password</label>
<input type="password" name="password" placeholder="Password.."><br>
<br><input type="submit" name="submit" value="login" class="btn btn-primary">



</form>
<br>
<!-- form-end -->

<p class="text-center">Designed by <a href="">Milan Sapkota</a></p>
    </div>
    <?php
    //login code
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){

            //getting the data from the web form 
            $user_name=$_POST['user_name'];
            $password=md5($_POST['password']);
//sql
$sql = "SELECT * FROM users where user_name = '$user_name' AND password='$password'";

//execute
$x = mysqli_query($conn , $sql);


//query is true
if($x == TRUE){
//if true
$count =mysqli_num_rows($x);
 
if($count ==1){
    $_SESSION['query'] ='<div class="success">Login Successfully!</div>';
    $_SESSION['user'] =$user_name;
    header('location:'.APP_URL.'admin/INDEX.php');

}else{
    $_SESSION['query'] ='<div class="error">your Credentials do not match our record!</div>';
    header('location:'.APP_URL.'admin/login.php');

}

}else{
    $_SESSION['query'] ='<div class="error">something is mistake in query</div>';
    header('location:'.APP_URL.'admin/login.php');
}
           
    }
}
    


    ?>
    
</body>
</html>