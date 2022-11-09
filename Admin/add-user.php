    <?php include('CommonToAll/header2all.php') ?>
    <!-- body sec. starts -->
    <section class="content">
            <div class="wrapper">
            <h1 class="heading" >ADD USER</h1>
            <br>
            <?php include('config/session.php') ?>
            <!-- Users table start -->
    <form method="post" action="add-user.php" >
        <table class="table">
            <tr>
                <td class="text-right">UserName:</td>
                <td><input type="text" name="user_name" placeholder="Enter your username" id="user-name" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">fullName:</td>
                <td><input type="text" name="full_name"  placeholder="Enter your name" id="full-name" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Password:</td>
                <td><input type="password" name="password" placeholder="**********" id="password" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary"></td>
            </tr>
        </table>
    </form>
    
            <!-- table ends -->

            </div>
        </section>
        <!-- body end here -->

    <?php include('CommonToAll/footer.php') ?>
    
    <?php 
    //form submit code
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
            var_dump($_POST);
            //getting the data from the web form 
            $full_name=$_POST['full_name'];
            $user_name=$_POST['user_name'];
            $password=md5($_POST['password']);

            //making sql
            $sql= "INSERT INTO users SET
            full_name='$full_name',
            user_name='$user_name',
            password='$password'
            ";
//check the connection
            if ($conn){
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                //create database
                if($execute = TRUE){
                    $_SESSION['message']= '<div class="success" > User Added Successfully</div>';
                    Header('location:'.APP_URL.'admin/manage_user.php');
                }else{
                    $_SESSION['message']= "could not Add User .Try Again!!";
                    Header('location:'.APP_URL.'admin/add-user.php');
                }
            }else{
                die("Connection Failed!". mysqli_connect_error());
            }
        }
    }
    


    ?>

