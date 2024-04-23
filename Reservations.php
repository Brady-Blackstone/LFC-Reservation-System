<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['admin']))
    die("No access!");
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
            $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Dashboard");
        }
        pageHeader("Reservations", $arr);
        ?>

        <h2>Reservations</h2>
        
        <form method ="post">
            <?php

            $start_time = strtotime('7:00 AM');
            $end_time = strtotime('5:00 PM');
            $interval = 30 * 60;

            for ($time = $start_time; $time < $end_time; $time += $interval){
                echo '<button type="submit" name="time" value="' . date('H:i', $time) . '">' . date('h:i A', $time) . '</button>';

            }
        ?>
        <br>
        <label for = "username">Your Username:</label>
        <input type = "text" name = "username" id="username" required>
        <br>
        <label for ="phone">Your Phone Number: </label>
        <input type = "text" name = "phone" id = "phone" required>
        <br>
        </form>

        <div class = "container">
            <div class = "row gx-5 mt-4">
                <div class = "col">
                    <table id = "rtable" class = "table table-hover table-success table-md">
                        <caption>Member reservations</caption>
                        <thead class = "table-secondary">
                        <tr>
                            <th scope = "col">Reservation ID</th>
                            <th scope = "col">Member ID</th>
                            <th scope = "col">Date</th>
                            <th scope = "col">Transaction Type</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src = "./js/reservation.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>