<?php include('CommonToAll/header2all.php') ?>
    <!-- body sec. starts -->
    <section class="content">
            <div class="wrapper">
            <h1 class="heading" >EDIT ORDER</h1>
            <br>
            <?php include('config/session.php') ?>
            <?php

            //getting id
            $id = $_GET['id'];
         
            //making sql to select value
            $sql = "SELECT * FROM orders where id='$id'";

            //execute the query
            $exec = mysqli_query($conn , $sql);

            //count the number of rows

            $count = mysqli_num_rows($exec);

            if($count == 1 ){
                while($rows=mysqli_fetch_assoc($exec)){
                    $id = $rows['id'];
                    $title = $rows['product'];
                    $price = $rows['price'];
                    $Quantity = $rows['quantity'];
                    $total = $rows['total'];
                    $name = $rows['customer_name'];
                    $address = $rows['customer_address'];
                    $email = $rows['customer_email'];
                    $contact = $rows['customer_contact'];
                }
        }
            ?>
            <!-- order table start -->
    <form method="post" action="" >
        <table class="table">
        <tr>
        <td class="text-right">Product:</td>
                <td>
                <select name="product" id="title" class="form-control">
                <?php
                //creating sql
                $sql1 = "SELECT * FROM products" ;

                //execute the query
                $execute = mysqli_query($conn ,$sql1);

                //if true
                if($execute == TRUE){
                    //count 
                    $count = mysqli_num_rows($execute);

                    if($count>0){
                      while( $rows=mysqli_fetch_assoc($execute)){
                        $category_name= $rows['title'];
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
                </td> 
            </tr>

            <tr>
                <td class="text-right">Name:</td>
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="product" value="<?php echo $title;?>">
                <td><input type="text" name="customer_name" value="<?php echo "$name"; ?>" placeholder="Enter your name" id="customer_name" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Email:</td>
                <td><input type="text" name="customer_email"  value="<?php echo "$email"; ?>" placeholder="Enter your email" id="customer_email" class="form-control"></td>
            </tr>
            </tr>
            <tr>
                <td class="text-right">Address:</td>
                <td><input type="text" name="customer_address"  value="<?php echo "$address"; ?>" placeholder="eg.banepa,kavre" id="customer_address" class="form-control"></td>
            </tr>
            </tr>
            <tr>
                <td class="text-right">Contact:</td>
                <td><input type="text" name="customer_contact" value="<?php echo "$contact"; ?>" placeholder="eg.98******" id="customer_contact" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Quantity:</td>
                <td><input type="number" name="quantity" min="1"  value="<?php echo "$Quantity"; ?>" placeholder="eg.1" id="Quantity" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
            $title=$_POST['product'];
            $price=$_POST['price'];
            $id = $_POST['id'];
            $Quantity = $_POST['quantity'];
            $total = $price * $Quantity;
            $name = $_POST['customer_name'];
            $address = $_POST['customer_address'];
            $contact = $_POST['customer_contact'];
            $email = $_POST['customer_email'];
            $id = $_POST['id'];

            //making sql
            $sql= "UPDATE orders SET
            product='$title',
            price='$price',
            quantity='$Quantity',
            total='$total',
            customer_name='$name',
            customer_address='$address',
            customer_email='$email',
            customer_contact='$contact'
             WHERE id='$id'
            ";
//check the connection
            if ($conn){
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                //create database
                if($execute = TRUE){
                    $_SESSION['message']= '<div class="success">Order updated Successfully</div>';
                    Header('location:'.APP_URL.'admin/manage-order.php');
                }else{
                    $_SESSION['message']= '<div class="error">could not Edit order .Try Again!!</div>';
                    Header('location:'.APP_URL.'admin/edit_order.php?id='.$id);
                }
            }else{
                die("Connection Failed!". mysqli_connect_error());
            }
        }
    }
    


    ?>

