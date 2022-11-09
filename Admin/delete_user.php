<?php

//getting connetion 
include('config/constants.php');
//taking the id
$id = $_GET['id'];


//making sql
$sql= "DELETE FROM USERS WHERE ID=$id";


//execute query
$exec =mysqli_query($conn,$sql);

//checking either true or false
if($exec == TRUE){
$_SESSION['message'] ='<div class="success">Users Deleted Successfully! </div>';
}else{
    $_SESSION['message'] ='<div class="error">Something Went Wrong! </div>';

}
header('location:' .APP_URL.'Admin/manage_user.php');



?>