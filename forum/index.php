<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include "partials/dbconnect.php" ?>
    <?php include "partials/header.php" ?>

    <!-- slider starts here -->

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider-3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider-1.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Category container starts here  -->


    <div class="container my-3">
        <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
        <div class="row my-3">
            <!-- Fetch all the Categories -->
            <!-- Use a for loop to iterate categories -->
            <?php 
            $sql = "SELECT * FROM `category`";
            $result=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                // echo $row['category_id'];
                // echo $row['category_name'];
                $id=$row['category_id'];
                $cat=$row['category_name'];
                $desc=$row['category_description'];
                echo '<div class="col-md-4 my-2 ">
                <div class="card" style="width: 18rem;">
                    <img src="img/card-'.$id.'.jpg" class="card-img-top" alt="image for category">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                        <p class="card-text">'.substr($desc,0,90).'...</p>
                        <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                    </div>
                </div>
            </div>';
            }
            
            ?>
            


        </div>
    </div>
    <?php include "partials/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

</body>

</html>