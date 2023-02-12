<?php

//getting connetion 
include('config/constants.php');
//taking the id
$id = $_GET['id'];
//finding the category in rder to  delete photo

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


//making sql
$sql= "DELETE FROM orders WHERE ID=$id";


//execute query
$exec =mysqli_query($conn,$sql);

//checking either true or false
if($exec == TRUE){
$_SESSION['message'] ='<div class="success">Order Deleted Successfully! </div>';
}else{
$_SESSION['message'] ='<div class="error">Something Went Wrong! </div>';

}
header('location:' .APP_URL.'Admin/manage-order.php');



?>