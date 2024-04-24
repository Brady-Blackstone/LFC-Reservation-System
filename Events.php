<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Events | littlefishingcreek</title>
        
        <link rel="stylesheet" href="./css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
              crossorigin="anonymous">
    </head>
    <body>
        <h1>Little Fishing Creek Golf Course</h1>

        <?php
        require_once './functions/pageFormat.php';

        // Display the navigation bar based on user/admin privelages or if no one is logged in
        if (isset($_SESSION['user']))
        {
            $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Profile", "Contact Us");
        }
        else if (isset($_SESSION['admin']))
        {
            $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Dashboard");
        }
        else
        {
            $arr = array("Home", "About", "Rates", "Events", "Login", "Signup", "Contact Us");
        }
        pageHeader("Events", $arr);
        ?>

        <h2>Golf Events & Tournaments</h2>

        <p>
            The Little Fishing Creek Golf Course offers local communities, business, colleges, churches, etc. to come and host 
            events and tournaments. Below you will find a list of all current golf events and tournaments that are taking place at 
            the Little Fishing Creek Golf Course. If you would like to sign up for anything listed below, or want to plan your own 
            golf event and/or tournament, give us a call at (478) 445-0796.
        </p>

        <ul class="ulHeader">
            <li>Weekly Events:</li>
            <li class="liBullet">Wednesday and Thursday Blitz starting at 9:00 a.m.</li>
        </ul>
        <ul class="ulHeader">
            <li>Upcoming Events/Tournaments:</li>
            <li class="liBullet"></li>
        </ul>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>