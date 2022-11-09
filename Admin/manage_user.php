<?php include('CommonToAll/header2all.php') ?>
<!-- body sec. starts -->
<section class="content">
        <div class="wrapper">
        <h1 class="heading" >MANAGE USER</h1>
        <br>
        <?php include('config/session.php') ?>
        <br>
        <a class="btn btn-secondary" href="add-user.php">Add user</a>
        <!-- Users table start -->

        <table class="table">
            <thead>
                <tr>
                <th>SN</th>
                <th>FullName</th>
                <th>UserName</th>
                <th>Action</th>
                </tr>
                
            </thead>
            <tbody>
                <?php
                //making the sql to fetch data from users table
                $sql="SELECT * FROM users ";
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
             $full_name = $rows['full_name'];
              $user_name =$rows['user_name'];
                ?>
                 <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $full_name;?></td>
                    <td><?php echo $user_name;?></td>
                    <td>
                    <a class="btn btn-secondary" href="<?php  echo APP_URL; ?>Admin/update_password.php?id=<?php echo $id; ?>">
                            Change Password
                                         </a>
                        <a class="btn btn-primary" href="<?php  echo APP_URL; ?>Admin/Edit_user.php?id=<?php echo $id; ?>">
                            Edit User
                               </a>
                        <a class="btn btn-danger" href="<?php  echo APP_URL; ?>Admin/delete_user.php?id=<?php echo $id; ?>">
                            Delete User
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