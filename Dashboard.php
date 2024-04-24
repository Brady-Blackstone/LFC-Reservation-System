<?php
session_start();
if (!isset($_SESSION['admin']))
    die("No access!");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard | littlefishingcreek</title>
        
        <link rel="stylesheet" href="./css/styles.css">
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

            #ftable caption
            {
                margin-left: 30%;
            }

            #rtable caption
            {
                margin-left: 35%;
            }
        </style>
    </head>
    <body>
        <h1>Little Fishing Creek Golf Course</h1>

        <?php
        require_once './functions/pageFormat.php';

        // Display navigation bar for the admin
        $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Dashboard");
        pageHeader("Dashboard", $arr);

        // Display an error message if there are no financial records in the database (which there already should be)
        if (isset($_SESSION['errMsg']))
        {
            $m = $_SESSION['errMsg'];
            unset($_SESSION['errMsg']);
            echo "<h5 class=\"alert alert-warning\">$m</h5>";
        }
        ?>

        <h2>Dashboard</h2>

        <br><br>

        <div class="container">
            <div class="row gx-5 mt-4">
                <div class="col">
                    <table id="ftable" class="table table-hover table-success table-md">
                        <caption>Financial Transaction Records</caption>
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">Financial Transaction ID</th>
                                <th scope="col">Member ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table id="rtable" class="table table-hover table-success table-md">
                    <caption>Reservation Records</caption>
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
        
        <script src="./js/admin.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>