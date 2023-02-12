<?php include('../CommonToAll/header2all.php') ?>
<!-- body sec. starts -->
<section class="content">
        <div class="wrapper">
        <h1 class="heading" >MANAGE CATEGORY</h1>
        <br>
        <?php include('../config/session.php') ?>
        <br>
        <a class="btn btn-secondary" href="add-category.php">Add Category</a>
        <!-- Users table start -->

        <table class="table">
            <thead>
                <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Action</th>
                </tr>
                
            </thead>
            <tbody>
                <?php
                //making the sql to fetch data from categories table
                $sql="SELECT * FROM categories ";
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
              $current_image =$rows['current_image'];
              $featured =$rows['featured'];
              $status =$rows['status'];
                ?>
                 <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title;?></td>
                    <td><?php echo $current_image;?></td>
                    <td><?php echo $featured;?></td>
                    <td><?php echo $status;?></td>

                    <td>

                        <a class="btn btn-primary" href="<?php  echo APP_URL; ?>Admin/category/Edit_categoty.php?id=<?php echo $id; ?>">
                            Edit Category
                               </a>
                        <a class="btn btn-danger" href="<?php  echo APP_URL; ?>Admin/category/delete_category.php?id=<?php echo $id; ?>">
                            Delete Category
                                         </a>
                                        
                                         
                                         
                                                  </td>
                                                </tr>
                                          <?php

}
                    }else{
                        echo '<tr><td colspan = "4">No rows to display</td><tr>';
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