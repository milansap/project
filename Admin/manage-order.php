<?php include('CommonToAll/header2all.php') ?>

<!-- body sec. starts -->
<section class="content">
        <div class="wrapper">
        <h1 class="heading" >MANAGE ORDER</h1>
        <br>
        <?php include('config/session.php') ?>
        <br>
        <!-- order table start -->
        <table class="table">
            <thead>
                <tr>
                <th>SN</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Customer Email</th>
                <th>Customer Contact</th>
                <th>Action</th>
                </tr>
                
            </thead>
            <tbody>
                <?php
                //making the sql to fetch data from categories table
                $sql="SELECT * FROM orders";
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
             $title = $rows['product'];
             $price=$rows['price'];
              $Quantity =$rows['quantity'];
              $total =$rows['total'];
              $name =$rows['customer_name'];
              $address =$rows['customer_address'];
              $email =$rows['customer_email'];
              $contact =$rows['customer_contact'];
            
                ?>
                 <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title;?></td>
                    <td><?php echo $price;?></td>
                    <td><?php echo $Quantity;?></td>
                    <td><?php echo $total;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $address;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $contact;?></td>
                    <td>

                        <a class="btn btn-primary" href="<?php  echo APP_URL; ?>Admin/Edit_order.php?id=<?php echo $id; ?>">
                            Edit Order
                               </a>
                        <a class="btn btn-danger" href="<?php  echo APP_URL; ?>Admin/delete_order.php?id=<?php echo $id; ?>">
                            Delete Order
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