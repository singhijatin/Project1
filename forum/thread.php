<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
    #ques{
        min-height:433px;
    }
    </style>
    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include "partials/dbconnect.php" ?>
    <?php include "partials/header.php" ?>

    <!-- slider starts here -->
    <!-- Category container starts here  -->
    <?php
    
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
        
        // Query the users table to find out the name of Original Poster
        $sql2= "SELECT user_email FROM users WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $posted_by=$row2['user_email'];
        
    }

    ?>

<?php
    $showalert=false;
      $method = $_SERVER['REQUEST_METHOD'];
      // echo $method;
        // INSERT INTO comment db
        if($method=='POST'){
        $comment=$_POST['comment'];
        $comment=str_replace("<", "&lt;", $comment);
        $comment=str_replace(">", "&gt;", $comment);
        $sno=$_POST['sno'];
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `coment_time`, `comment_by`) VALUES ( '$comment', '$id', current_timestamp(), '$sno')";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>Your Comment has been added.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>';
        }
     }
    ?>


    <div class="container my-4" >
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?> </h1>
            <p class="lead"><?php echo $desc ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forumsis not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>

            <p>Posted by <b> <em><?php echo $posted_by; ?></em></b></p>

        </div>
    </div>

    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    
    echo ' <div class="container">
    <h1 class="py-2">Post A Comment</h1>

    <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
        
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Type your Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            
        </div>
        <button type="submit" class="btn btn-success my-3">Post Comment</button>
    </form>
</div>';
    }
    else{
            echo '<div class="container">
            <h1 class="py-2">Post a Comment</h1>
            <p class="lead">You are not logged it. Please login to be able to post a comment.</p>
            </div>';
    }
    ?>

    <div class="container mb-5" id = "ques">
        <h1 class="py-2">Discussion</h1>
       
    <?php
    
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
    $result=mysqli_query($conn,$sql);
    $noResult=true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult=false;
        $id = $row['comment_id'];
        $content=$row['comment_content'];
        $comment_t=$row['coment_time'];
        $thread_user_id=$row['comment_by'];
        $sql2= "SELECT user_email FROM users WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        

        echo '<div class="media my-3">
            <img class="mr-3" src="img/userdefault.png" width="54px" alt="...">
            <div class="media-body">
            <p class ="font-weight-bold my-0"><b>'.$row2['user_email'] .' at :'.$comment_t.'</b></p>
                '.$content.'
            </div>
        </div>';

        
        }
        if($noResult)
        {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container" >
              <p class="display-6" >No Comments Found </p>
              <p class="lead">Be the first person to comment</p>
            </div>
          </div>';
        }
    ?>

    </div>

    <?php include "partials/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

</body>

</html> 