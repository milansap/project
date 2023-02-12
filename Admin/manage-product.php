<?php include('CommonToAll/header2all.php') ?>

<!-- body sec. starts -->
<section class="content">
        <div class="wrapper">
        <h1 class="heading" >MANAGE PRODUCT</h1>
        <br>
        <?php include('config/session.php') ?>
        <br>
        <a class="btn btn-secondary" href="add-product.php">Add Product</a>
        <!-- product table start -->

        <table class="table">
            <thead>
                <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                
            </thead>
            <tbody>
                <?php
                //making the sql to fetch data from categories table
                $sql="SELECT * FROM products ";
                //execute the query
                $exec = mysqli_query($conn,$sql);

                //if there is something 
                if($exec == TRUE){
                    //count the number of rows
                    $count = mysqli_num_rows($exec);

        if($count > 0){
            $sn=1;
         while($rows = mysqli_fetch_assoc($exec)){
            $id = $rows['id'];
             $title = $rows['title'];
             $price=$rows['price'];
              $current_image =$rows['image_name'];
              $featured =$rows['featured'];
              $status =$rows['status'];
                ?>
                 <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title;?></td>
                    <td><?php echo $price;?></td>
                     <?php  
                     if($current_image !=""){

                        ?>
                        <td>
                        <img width="100" height="100" src="../IMAGES/product/<?php echo $current_image; ?>" alt="../IMAGES/product/<?php echo $title; ?>">
                        </td>
                     <?php
                     }else{
                        echo '<td>No Image Found</td>';
                     }
                     ?>


                    <td><?php echo $featured;?></td>
                    <td><?php echo $status;?></td>

                    <td>

                        <a class="btn btn-primary" href="<?php  echo APP_URL; ?>Admin/Edit_Product.php?id=<?php echo $id; ?>">
                            Edit Product
                               </a>
                        <a class="btn btn-danger" href="<?php  echo APP_URL; ?>Admin/delete_Product.php?id=<?php echo $id; ?>">
                            Delete Product
                                         </a>
                                        
                                         
                                         
                                                  </td>
                                                </tr>
                                          <?php

}
                    }else{
                        echo '<tr><td colspan = "7" class="text-center">Nothing to display</td><tr>';
                    }
                }
                
                ?>
            </tbody>
        </table>
        <!-- table ends -->

        </div>
    </section>
    <!-- body end here -->



<?php include('CommonToAll/footer.php') ?>