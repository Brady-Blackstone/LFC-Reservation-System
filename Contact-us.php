<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us | littlefishingcreek</title>
        
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
        pageHeader("Contact Us", $arr);
        ?>

        <h2>Contact Us</h2>

        <br>

        <h3>Little Fishing Creek Golf Course</h3>

        <table>
            <tr>
                <td>65 Highway 22 West</td>
            </tr>
            <tr>
                <td>Milledgeville, GA 31061</td>
            </tr>
            <tr>
                <td>(478) 445-0796</td>
            </tr>
            <tr>
                <td>kwall@baldwincountyga.com</td>
            </tr>
        </table>

        <br>

        <iframe
            width="500px"
            height="150px"
            style="border:0"
            loading="lazy"
            allowfullscreen
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9720.441261972403!2d-83.28951404829509!3d33.09017105053608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f6c7dd0d34b8a7%3A0xb323ab6ea6810407!2sLittle%20Fishing%20Creek%20Golf%20Course!5e0!3m2!1sen!2sus!4v1712423486546!5m2!1sen!2sus">
        </iframe>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>