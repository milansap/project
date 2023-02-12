<?php 
include('layout/header.php');
?>
    <!-- Search  Begins Here -->
    <?php
    // get the id of product
    $product_id= $_GET['id'];


    //sql to get the product
    $sql ="SELECT * FROM PRODUCTS where id ='$product_id' ";

    $exe= mysqli_query($conn,$sql);

    //check if executed
    if($exe ==TRUE){
     //count the number of rows
     $count=mysqli_num_rows($exe);

     //if exactly 1
     if($count ==1){
while($rows=mysqli_fetch_assoc($exe)){
    $product_title = $rows['title'];
    // $product=$rows['product'];
    $product_id=$rows['id'];
    $product_ima =$rows['image_name'];
    $product_price =$rows['price'];
    $product_des =$rows['description'];
}
     }else{
        header('location:'.APP_URL); 
     }
    }else{
        header('location:'.APP_URL);
    }
    ?>
    <section class="Search  text-white">
        <div class="container">
            <h2 class="text-center contact-heading ">Send us a Message</h2>
            <form  method="post" action="" class="form-horizontal">
                <fieldset>
               <legend>Selected item:</legend>
               <div class="box-img">
                <img src="images/product/<?php echo $product_ima; ?>" alt="<?php echo $product_title; ?>" class="img-responsive img-rounded">
            </div>
            <div class="box-desc">
                <h3><?php echo $product_title; ?></h3>
                <p class="item-price">$<?php echo $product_price;?></p>
                <p class="item-desc"><?php echo $product_des; ?></p>
            </div>
                </fieldset>

                <fieldset>
                    <legend>Personal Details:</legend>
                <label for="">Name</label>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                <input type="hidden" name="product" value="<?php echo $product_title;?>">
                <input class="form-control" type="text" name="name" id="name"  required placeholder="Enter your name..">

                <label for="">Email</label>
                <input class="form-control" type="text" name="email" id="email"  required placeholder="Enter your email..">

                <label for="">Address</label>
                <input class="form-control" type="text" name="Address" id="Address" required  placeholder="eg.Banepa,kavre">

                <label for="">Contact</label>
                <input class="form-control" type="text" name="contact" id="contact" required  placeholder="eg.98*****">




                <label for="">Quantity</label>
                <input class="form-control" type="number" min="1" name="Quantity" id="Quantity" required placeholder="eg.1" value="">


                <label for="">Feedback</label>
                <textarea class="form-control" name="Feedback" id="Feedback" cols="30" rows="10"required placeholder="Enter your Feedback..."></textarea>

                <input type="submit" name="submit" class="btn btn-primary">
         
            </fieldset>
            </form>
        </div>
    </section>
    <!-- Search Section Ends Here -->
    <?php
    //to sumbit the form
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
            //getting the data from the web form 
              $product_id =$_POST['product_id'];
              $price=$_POST['product_price'];
              $quantity=$_POST['Quantity'];
              $total=$price*$quantity;
              $customer_name=$_POST['name']; 
              $customer_address=$_POST['Address']; 
              $customer_email=$_POST['email']; 
              $customer_contact=$_POST['contact']; 
              $customer_feedback=$_POST['Feedback']; 
              $order_date=date('Y-m-d H:i:sa');
              $product=$_POST['product']; 
        
            //making sql
            $sql= "INSERT INTO orders SET
            product_id ='$product_id',
            product ='$product',
            price='$price',
            quantity ='$quantity',
            total='$total',
            customer_name='$customer_name',
            customer_address ='$customer_address',
            customer_email='$customer_email',
            customer_contact='$customer_contact',
            customer_feedback='$customer_feedback',
            order_date='$order_date'";


                //check the connection
            if ($conn){
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                //create database
                if($execute = TRUE){
                    $_SESSION['message']= '<div class="success" >Order Placed Successfully</div>';
                    Header('location:'.APP_URL);
                }else{
                    $_SESSION['message']= "could not Add Order Instantly.Try Again!!";
                    Header('location:'.APP_URL.'order.php?id=$id');
                }
            }else{
                die("Connection Failed!". mysqli_connect_error());
            }
        }
    }

    ?>

<?php 
 include('layout/foter.php');
?>
