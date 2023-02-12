<?php

//getting connetion 
include('config/constants.php');
//taking the id
$id = $_GET['id'];
//finding the category in rder to  delete photo

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
          $featured = $rows['featured'];
          $status = $rows['status'];
          $current_image = $rows['image_name'];

           //remove the old imgae
      if(file_exists("../IMAGES/product/".$current_image)){
        @unlink("../IMAGES/product/".$current_image);
     }
      }
}


//making sql
$sql= "DELETE FROM PRODUCTS WHERE ID=$id";


//execute query
$exec =mysqli_query($conn,$sql);

//checking either true or false
if($exec == TRUE){
$_SESSION['message'] ='<div class="success">product Deleted Successfully! </div>';
}else{
$_SESSION['message'] ='<div class="error">Something Went Wrong! </div>';

}
header('location:' .APP_URL.'Admin/manage-product.php');



?>