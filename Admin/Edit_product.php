<?php include('CommonToAll/header2all.php') ?>
    <!-- body sec. starts -->
    <section class="content">
            <div class="wrapper">
            <h1 class="heading" >EDIT PRODUCT</h1>
            <br>
            <?php include('config/session.php') ?>
            <?php

            //getting id
            $id =$_GET['id'];
         
            //making sql to select value
            $sql = "SELECT * FROM products where id='$id'";

            //execute the query
            $exec = mysqli_query($conn , $sql);

            //count the number of rows

            $count = mysqli_num_rows($exec);

            if($count == 1 ){
                while($rows=mysqli_fetch_assoc($exec)){
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $price = $rows['price'];
                    $description = $rows['description'];
                    $old_category_id = $rows['category_id'];
                    $featured = $rows['featured'];
                    $status = $rows['status'];
                    $current_image = $rows['image_name'];
                }
        }
            ?>
            <!-- product table start -->
    <form method="post" action="" enctype="multipart/form-data" >
    <table class="table">
            <tr>
                <td class="text-right">Title:</td>
                <td><input type="text" name="title" value="<?php echo $title ?>" placeholder="Enter your Title" id="title" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Price:</td>
                <td><input type="number" name="price" value="<?php echo $price ?>" placeholder="Enter your price..." id="price" class="form-control"></td>
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
                        $category_id = $rows['id'];
                        ?>
                    <option <?php if($category_id !="" && $category_id == $old_category_id){ echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_name;?></option>
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
                    <textarea rows="5" name="description" placeholder="Enter your Description..." id="description" class="form-control"><?php echo $description; ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="text-right">Current Image:</td>
                <?php  
                     if($current_image !=""){

                        ?>
                        <td>
                        <img width="100" height="100" src="../IMAGES/product/<?php echo $current_image; ?>" alt="../IMAGES/category/<?php echo $title; ?>">
                        </td>
                     <?php
                     }else{
                        echo '<td>No Image Found</td>';
                     }
                     ?>

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
                    <input type="radio" <?php if($featured == "Yes"){echo "Checked";}?> name="featured" id="" value="Yes">Yes
                    <input type="radio" <?php if($featured == "No"){echo "Checked";}?> name="featured" id="" value="No">No
            </td>
            </tr>
            <tr>
                <td class="text-right">Status:</td>
                <td>
                    <input type="radio" <?php if($status == "Yes"){echo "Checked";}?> name="status" id="" value="Yes">Active
                    <input type="radio" <?php if($status == "No"){echo "Checked";}?> name="status" id="" value="No">Inactive
            </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary"></td>
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
            $title= $_POST['title'];
            $price= $_POST['price'];
            $description= $_POST['description'];
            $category_id= $_POST['$category_id'];
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
                $status = $_POST['status'];

            }else{
                //default value
                $status= "No"; 
            }


            $id = $_POST['id'];
            $current_image =$_POST['current_image'];
            //upload file or image
              //check if request file
              if($_FILES['image']['name']){
                //taking the extension
                $ext =end(explode('.',$_FILES['image']['name']));
                //giving random names
                $image = 'category_'.rand(1111,9999).'.'.$ext;
                

            //upload image
            $uploaded_path =$_FILES['image']['tmp_name'];
            $destination_path="../IMAGES/product/".$image;

            $upload = move_uploaded_file($uploaded_path,$destination_path);


            if($upload == false){
                $_SESSION['message']= '<div class="error">could not upload the image</div>';
                die();
            }else{
             $image_name= $image;

             //remove the old imgae
             if(file_exists("../IMAGES/product/".$current_image)){
                @unlink("../IMAGES/product/".$current_image);
             }
            }
                    }else{
                $image_name = $current_image;
            }

            //making sql
            $sql="UPDATE  products SET
            title='$title',
            price='$price',
            description='$description',
            category_id='$category_id',
            featured='$featured',
            status='$status',
            image_name='$image_name'
            WHERE id= $id";
//check the connection
            if ($conn){
                $execute = mysqli_query($conn , $sql) or die(mysqli_error($conn));
                //create database
                if($execute == TRUE){
                    $_SESSION['message']= '<div class="success">product updated Successfully</div>';
                    Header('location:'.APP_URL.'admin/manage-product.php');
                }else{
                    $_SESSION['message']= '<div class="error">could not Edit product .Try Again!!</div>';
                    Header('location:'.APP_URL.'admin/Edit_product.php?id'.$id);
                }
            }else{
                die("Connection Failed!". mysqli_connect_error($conn));
            }
        }
    }
    


    ?>

