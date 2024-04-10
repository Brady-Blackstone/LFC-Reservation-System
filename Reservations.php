<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reservations | littlefishingcreek</title>
        
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
            $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Contact Us");
        }
        else if (isset($_SESSION['admin']))
        {
            $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Admin Page", "Contact Us");
        }
        else
        {
            $arr = array("Home", "About", "Rates", "Events", "Login", "Signup", "Reservations", "Admin Page", "Contact Us");
        }
        pageHeader("Reservations", $arr);
        ?>

        <h2>Reservations</h2>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>