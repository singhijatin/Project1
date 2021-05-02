<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
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
    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category` WHERE category_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }

    ?>
    <!-- Hello -->
    <?php
    $showalert=false;
      $method = $_SERVER['REQUEST_METHOD'];
      // echo $method;
        // iNSERT iNTO DB
        if($method=='POST'){
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];

        $th_title=str_replace("<", "&lt;", $th_title);
        $th_title=str_replace(">", "&gt;", $th_title);

        $th_desc=str_replace("<", "&lt;", $th_desc);
        $th_desc=str_replace(">", "&gt;", $th_desc);
        
        $sno=$_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id','$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>Your thread has been added.Please wait for the community to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>';
        }
     }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?> </h1>
            <p class="lead"><?php echo $catdesc ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forumsis not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>

            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>

        </div>
    </div>

     <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    
    echo' <div class="container">
        <h1 class="py-2">Start a Discussion</h1>

        <form action="'. $_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title"
                    placeholder="title">
                <small id="title" class="form-text text-muted">Keep your title as short as crisp as possible</small>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success my-3">Submit</button>
        </form>
    </div>';
    }
    else{
            echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <p class="lead">You are not logged it. Please login to be able to start a Discussion</p>
            </div>';
    }
    ?>
    

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
    $result=mysqli_query($conn,$sql);
    $noResult=true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult=false;
        $id = $row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_time=$row['timestamp'];
        $thread_user_id=$row['thread_user_id'];
        $sql2= "SELECT user_email FROM users WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);

        echo '<div class="media my-3">
            <img class="mr-3" src="img/userdefault.png" width="54px" alt="...">
            <div class="media-body">'.
            
            '<h5 class="mt-0"><a class="text-dark"  href ="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                '.$desc.' </div><p class ="font-weight-bold my-0"> ---- Asked By <b>'.$row2['user_email'].' at '.$thread_time.'</b></p>'.
        '</div>';
 }
        // echo var_dump($noResult);
        if($noResult)
        {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container" >
              <p class="display-6" >No Threads Found</p>
              <p class="lead">Be the first person to ask the question</p>
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