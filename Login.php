<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | littlefishingcreek</title>
        
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
        pageHeader("Login", $arr);
        ?>

        <div class="container d-flex justify-content-center login_box">
            <h2>Login</h2>
            <form id="login" action="./handlers/Login-Handler.php" method="POST">
                <div class="row mb-1 justify-content-center">
                    <div class="col-auto">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Username*" id="userID" name="userID" required>
                            <label for="userID">Username*</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-1 justify-content-center">
                    <div class="col-auto">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Password*" id="pwd" name="pwd" required>
                            <label for="pwd">Password*</label>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-1 justify-content-center">
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-dark btnL me-2">Cancel</button>
                            <button type="submit" class="btn btn-dark btnL ms-4">Signup</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.getElementById('login').addEventListener('submit', function(event)
            {
                // Prevent the signup button from submitting normally to an action file
                event.preventDefault();

                // Get form values
                const userID = document.getElementById('userID').value;
                const pwd = document.getElementById('pwd').value;

                // JSON object
                const loginData = 
                {
                    USERNAME: userID,
                    PASSWORD: pwd
                };

                // Display JSON object as a string in the console and can be sent to the server
                console.log(JSON.stringify(loginData));
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>