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
        <title>Profile | littlefishingcreek</title>
        
        <link rel="stylesheet" href="./css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
              crossorigin="anonymous">
        <style>
            #table
            {
                width: 50%;
            }
        </style>
    </head>
    <body>
        <h1>Little Fishing Creek Golf Course</h1>

        <?php
        require_once './functions/pageFormat.php';

        // Display the navigation bar for the user
        $arr = array("Home", "About", "Rates", "Events", "Logout", "Reservations", "Profile", "Contact Us");
        pageHeader("Profile", $arr);

        // Display an error message if the deactivation was unsuccessful
        if (isset($_SESSION['errMsg']))
        {
            $m = $_SESSION['errMsg'];
            unset($_SESSION['errMsg']);
            echo "<h5 class=\"alert alert-warning\">$m</h5>";
        }
        ?>

        <h2>Profile</h2>

        <br><br>

        <div class="container d-flex justify-content-center">
            <table id="table" class="table table-hover table-success table-md">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <br><br><br>

        <div class="btnCenter">
            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete Account</button>
        </div>

        <script>
            function confirmDelete() 
            {
                if (confirm("Are you sure you want to delete your account?")) 
                {
                    if (confirm("This action is irreversible. Are you absolutely sure?")) 
                    {
                        // Redirect to the account handler
                        window.location.href = "./handlers/accountHandler.php";
                    }
                }
            }
        </script>

        <script src="./js/profile.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>