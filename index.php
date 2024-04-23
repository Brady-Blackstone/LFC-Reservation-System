<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Little Fishing Creek Golf Course | Milledgeville</title>
        
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
            $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Dashboard");
        }
        else
        {
            $arr = array("Home", "About", "Rates", "Events", "Login", "Signup", "Contact Us");
        }
        pageHeader("Home", $arr);
        ?>

        <h2>Welcome to the Little Fishing Creek Golf Course!</h2>

        <p>Little Fishing Creek Golf Course is the home of the finest golf course in Middle Georgia!</p>

        <p>
            Here at Little Fishing Creek we take pride not only in our course itself but also our 
            loyal members and new patrons. Any and all golfers are welcome to play, no matter 
            their level of skill. Each hole is unique in the fact that they all act different and provide 
            a golfer with challenging and rigorous shots. Come out today and see what 
            Little Fishing Creek Golf Course has to offer!
        </p>

        <p>To learn what the going rates are to play, visit the Rates page!</p>
        <p>To become a member or find out more information, visit the Membership page!</p>
        <p>To be apart of local tournaments and other events, visit the Events page!​</p>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>