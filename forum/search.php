<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
    #maincontainer {
        min-height: 100vh
    }
    </style>

    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include "partials/dbconnect.php" ?>
    <?php include "partials/header.php" ?>


    <div class="container my-3" id="maincontainer">
        <h1>Search results for "<?php echo $_GET['search'] ?>"</h1>
        <?php
            $noresults=true;
            $query =$_GET["search"];
            $sql = "select * from threads where match(thread_title,thread_desc) against ('$query')";
            $result=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $thread_id=$row['thread_id'];
                $url="thread.php?threadid=".$thread_id;
                $noresults=false;
            
            // Display the serach Result
            echo '<div class="result my-2">
            <h3><a href="/category/ddf" class="text-dark"> '.$title.' </a></h3>
            <p>'.$desc.'</p>
            </div>'; 
            }
        if($noresults){
        echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Results found</p>
                        <p class="lead"> Suggestions: <ul>
                       <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li></ul>
                        </p>
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