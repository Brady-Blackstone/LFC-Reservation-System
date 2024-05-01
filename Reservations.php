<?php
session_start();
if (!isset($_SESSION['user']))
    die("No access!");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reservations | littlefishingcreek</title>
        <link rel="stylesheet" href="./css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
                rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
                crossorigin="anonymous">
        <style>
            caption 
            {
                color: black;
                font-weight: bold;
            }

            #dateInput, #editFormContainer, #cancelFormContainer
            {
                display: inline-block; 
                vertical-align: top; 
                margin-left: 10px; 
            }

            .inWidth
            {
                width: 250px !important;
            }
        </style>
    </head>
    <body>
        <h1>Little Fishing Creek Golf Course</h1>
        <?php
        require_once './functions/pageFormat.php';

        // Display navigation bar for the user
        $arr = ["Home", "About", "Rates", "Events", "Logout", "Reservations", "Profile", "Contact Us"];
        pageHeader("Reservations", $arr);

        // Display an error message if there are no reservations in the database (which there already should be)
        if (isset($_SESSION['errMsg']))
        {
            $m = $_SESSION['errMsg'];
            unset($_SESSION['errMsg']);
            echo "<h5 class=\"alert alert-warning\">$m</h5>";
        }
        ?>
        <h2>Reservations</h2>

        <br><br>

        <script src="./js/reservation.js"></script>
        <form method="post" id="reservationForm">
            <button type="button" id="bookButton" class="btn btn-success">Book</button>
            <input type="date" id="dateInput" class="inWidth">
            <br><br>
            <button type="button" id="editButton" class="btn btn-warning">Edit</button>
            <div id="editFormContainer"></div>
            <br><br>
            <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button>
            <div id="cancelFormContainer"></div>
        </form>

        <br>

        <div class="container">
            <div class="row gx-5 mt-4">
                <div class="col">
                    <table id="rtable" class="table table-hover table-success table-md">
                        <caption>Member reservations</caption>
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">Reservation ID</th>
                                <th scope="col">Member ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Transaction Type</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                    crossorigin="anonymous">
        </script>
    </body>
</html>