<?php 
include('layout/header.php');
?>
    
        <section class="Search text-center">
            <div class="container">
                <form  method="GET" action="searchresult.php">
                    <input type="search" name="search" placeholder="Search for food....." id="search">
                    <input type="submit" value="search" class="btn btn-primary">
                </form>

            </div>
    
    
        </section>
    
    
        <section class="catagories">
            <div class="container">
                <h2 class="text-center">Catagories</h2>
                <?php
//create the sql to pull the category
$sql= "SELECT * FROM CATEGORIES WHERE  status='Yes'";

//execute the query
$execute = mysqli_query($conn,$sql);

//if execution is correctly submitted
if($execute == TRUE){

    //count the rows
    $count =mysqli_num_rows($execute);

    //if count is greater than 0 
    if($count> 0){
        while($rows=mysqli_fetch_assoc($execute)){
        $id=$rows['id'];
        $category_title=$rows['title'];
        $category_image=$rows['image_name'];
        ?>
            <a href="food.php">
                <div class="card float-container">
                  <img src="images/category/<?php echo $category_image;?>" alt="<?php echo $category_title; ?>"  class="img-responsive img-rounded">
                  <h3 class="float-text text-white"><?php echo $category_title;?></h3>
                 </div>
              </a>
        <?php
        }
    }else{
      echo "<div class='full_width text-center'>No Category Found</div>";
    }
}
            ?>
                <div class="clearfix"></div>
            </div>
    
    
        </section>
       <?php
       include('layout/foter.php');
       ?>