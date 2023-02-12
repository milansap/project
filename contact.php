<?php 
include('layout/header.php');
?>
    <!-- Search  Begins Here -->
    <section class="Search text-center text-white">
        <div class="container">
            <h2 class="text-center contact-heading ">Send us a Message</h2>
            <form action="" class="form-horizontal">
                <label for="">Name</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Enter your name..">

                <label for="">Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="Enter your email..">

                <label for="">Message</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Enter your message.."></textarea>

               <a href="#"> <button class="btn btn-primary">Submit</button></a>
            </form>
        </div>
    </section>
    <!-- Search Section Ends Here -->

    <!-- Contact Form Section -->
    <section class="contact">
       
    </section>
    <!-- Contact Form Section Ends -->

    <?php 
    include('layout/foter.php');
    ?>
