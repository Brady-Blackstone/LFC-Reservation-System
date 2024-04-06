<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About | littlefishingcreek</title>
        
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
              crossorigin="anonymous">
    </head>
    <body>
        <h1>Little Fishing Creek Golf Course</h1>

        <?php
        require_once './functions/pageFormat.php';

        $arr = array("Home", "About", "Rates", "Events", "Login", "Signup", "Reservations", "Admin Page", "Contact Us");
        pageHeader("About", $arr);
        ?>

        <h2>About the Little Fishing Creek Golf Course!</h2>

        <p>
            Little Fishing Creek Golf Course opened in 1981. It is an 18 hole public golf 
            course owned and operated by Baldwin County. The General Manager 
            is Kyle Wall. The Golf Course Superintendent is Ken Sanvidge. The course is 
            18 holes with a driving range and a practice putting/chipping green. Greens 
            and fairways are bermuda grass. The course offers a challenging layout with 
            several blind shots and scenic views. It plays roughly 6700 yards from the 
            championship tees and 5500 yards from the ladies tees.
        </p>

        <div class="container d-flex justify-content-center">
            <img src="img/yardage.jpg" alt="Course Yardage" width="600" height="124">
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>