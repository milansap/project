    <?php include('CommonToAll/header2all.php') ?>
    <!-- body sec. starts -->
    <section class="content">
            <div class="wrapper">
            <h1 class="heading" >ADD PRODUCT</h1>
            <br>
            <?php include('config/session.php')?>
            <!-- Users table start -->

    <form enctype="multipart/form-data" method="post" action="add-product.php" >
        <table class="table">
            <tr>
                <td class="text-right">Title:</td>
                <td><input type="text" name="title" placeholder="Enter your Title" id="title" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Price:</td>
                <td><input type="number" name="price" placeholder="Enter your price..." id="price" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Category:</td>
                <td>
                <select name="category_id" id="category" class="form-control">
                <?php
                //creating sql
                $sql1 = "SELECT * FROM categories" ;

                //execute the query
                $execute = mysqli_query($conn ,$sql1);

                //if true
                if($execute == TRUE){
                    //count 
                    $count = mysqli_num_rows($execute);

                    if($count>0){
                      while( $rows=mysqli_fetch_assoc($execute)){
                        $category_name = $rows['title'];
                        $category_id =$rows['id'];
                        ?>
                    <option value="<?php echo $category_id;?>"><?php echo $category_name;?></option>
                        <?php
                     
                      }

                    }else{
                        echo '<option>NO Category </option>';
                    }
                }else{
                    echo '<option>NO Category </option>';
                }
                ?>

                </select>
            </tr>
            <tr>
                <td class="text-right">Description:</td>
                <td>
                    <textarea rows="5" name="description" placeholder="Enter your Description..." id="description" class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td class="text-right">Image:</td>
                <td>
                    <input type="file" accept="image/*" name="image" id="image" class="form-control">
                </td>
            </tr>
            <tr>
                <td class="text-right">Featured:</td>
                <td>
                    <input type="radio" name="featured" id="" value="Yes">Yes
                    <input type="radio" name="featured" id="" value="No">No
            </td>
            </tr>
            <tr>
                <td class="text-right">Status:</td>
                <td>
                    <input type="radio" name="status" id="" value="Yes">Active
                    <input type="radio" name="status" id="" value="No">Inactive
            </td>
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
            //getting the data from the web form 
            $title =$_POST['title'];
            $price=$_POST['price'];
              $description=$_POST['description'];
              $category_id=$_POST['category_id'];

            //to populate the default value of featured
            if(isset($_POST['featured'])){
                //request value
                $featured=$_POST['featured'];

            }else{
                //default value
                $featured= "No"; 
            }

             //to populate the default value of status
             if(isset($_POST['featured'])){
                //request value
                $status=$_POST['status'];

            }else{
                //default value
                $status= "No"; 
            }

            //image upload


            //check if request file
            if($_FILES['image']['name']){
                $image=$_FILES['image']['name'];

                //taking the extension
                $ext =end(explode('.',$_FILES['image']['name']));
                //giving random names
                $image = 'products_'.rand(1111,9999).'.'.$ext;
                
            //upload image
            $uploaded_path =$_FILES['image']['tmp_name'];
            $destination_path="../IMAGES/product/".$image;

            $upload = move_uploaded_file($uploaded_path,$destination_path);

            if($upload == false){
                $_SESSION['message']= '<div class="error">could not upload the image</div>';
                die();
            }else{
             $image_name= $image;
            }
                    }else{
                $image_name ="";
            }

            //making sql
            $sql= "INSERT INTO products SET
            title ='$title',
            price ='$price',
            category_id ='$category_id',
            description ='$description',
            image_name='$image_name',
            featured ='$featured',
            status='$status'";
                //check the connection
            if ($conn){
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                //create database
                if($execute = TRUE){
                    $_SESSION['message']= '<div class="success" >product Added Successfully</div>';
                    Header('location:'.APP_URL.'admin/manage-product.php');
                }else{
                    $_SESSION['message']= "could not Add product .Try Again!!";
                    Header('location:'.APP_URL.'admin/add-product.php');
                }
            }else{
                die("Connection Failed!". mysqli_connect_error());
            }
        }
    }
    


    ?>

