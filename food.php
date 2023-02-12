<?php 
include('layout/header.php');
?>

    <section class="Search text-center">
        <div class="container">
            <form method="GET" action="Searchresult.php">
                <input  type="search" name="search" placeholder="Search for food....." id="search">
                <input type="submit" value="search" class="btn btn-primary">
            </form>
        </div>


    </section>
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Product</h2>
            <?php

//sql to fetch peoducts
$product_sql ="SELECT * FROM products where featured ='Yes' and status ='Yes' limit 20";

//$execute sql
$pro_exe = mysqli_query($conn,$product_sql);

//check if execution is true 
if($pro_exe == TRUE ){
  //count the number of rows
  $count = mysqli_num_rows($pro_exe);

if($count >0){
  //run loop
  while($p_rows = mysqli_fetch_assoc($pro_exe)){
      $pro_id=$p_rows['id'];
      $pro_title=$p_rows['title'];
      $pro_description=$p_rows['description'];
      $pro_price=$p_rows['price'];
      $pro_image=$p_rows['image_name'];
       ?>
<div class="box">
  <div class="box-img">
      <img src="images/product/<?php echo $pro_image; ?>" alt="<?php echo $pro_title; ?>" class="img-responsive img-rounded">
  </div>
      <div class="box-desc">
      <h3><?php echo $pro_title; ?> </h3>
      <p class="item-price">$<?php echo $pro_price ;?></p>
      <p class="item-desc"><?php echo $pro_description ;?> </p>
      <a href="<?php echo APP_URL;  ?>order.php?id=<?php echo $pro_id;  ?>" class="btn btn-primary">Order Now</a>
  </div>
  </div>
      <?php
  }

}else{
  echo "<div class='full_width text-center'>No Products Found</div>";
}
}
            ?>
                <div class="clearfix"></div>
            </div>


    </section>

    <?php 
    include('layout/foter.php');
    ?>
