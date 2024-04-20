<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Signup | littlefishingcreek</title>
        
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

        // Display navigation bar before anyone signs up
        $arr = array("Home", "About", "Rates", "Events", "Login", "Signup", "Contact Us");
        pageHeader("Signup", $arr);

        // Display an error message if the any of the entered information is invalid
        // From client-side
        echo "<h5 id=\"errMsg\" class=\"alert alert-warning\"></h5>";

        // From server-side, just in case a user's browser has javascript disabled
        if (isset($_SESSION['errMsg']))
        {
            $m = $_SESSION['errMsg'];
            unset($_SESSION['errMsg']);
            echo "<h5 class=\"alert alert-warning\">$m</h5>";
        }
        ?>

        <!-- This form is centered on the page and has floating placeholder / label values -->
        <div class="container d-flex justify-content-center signup_box">
            <h2>Signup</h2>
            <br>
            <p>Please fill in the following fields to create an account</p>
            <form action="./handlers/signupHandler.php" onsubmit="return validateSignupForm()" method="POST">
                <!-- 1st Row: Name -->
                <div class="row mb-1">
                    <label>Your Name*</label>
                    <div class="col-auto">
                        <div class="form-floating">
                            <input type="text" class="inWidth form-control" placeholder="First Name*" id="fname" name="fname" required>
                            <label for="fname">First Name*</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-floating">
                            <input type="text" class="inWidth form-control" placeholder="Last Name*" id="lname" name="lname" required>
                            <label for="lname">Last Name*</label>
                        </div>
                    </div>
                </div>
                 <!-- 4th Row: Username and Password -->
                 <div class="row mb-1">
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Username*" id="userID" name="userID" required>
                            <label for="userID">Username*</label>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="password" class="form-control" placeholder="Password*" id="pwd" name="pwd" required>
                            <label for="pwd">Password*</label>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="password" class="form-control" placeholder="Confirm Password*" id="cpwd" name="cpwd" required>
                            <label for="cpwd">Confirm Password*</label>
                        </div>
                    </div>
                </div>
                <!-- 2nd Row: Contact Information -->
                <div class="row mb-1">
                    <label>Contact Information*</label>
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="tel" class="form-control" placeholder="Phone Number*" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" id="phone" name="phone" required>
                            <label for="phone">Phone Number*</label>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="email" class="form-control" placeholder="Email*" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}(?:.[a-zA-Z]{2,})?" id="email" name="email" required>
                            <label for="email">Email*</label>
                        </div>
                    </div>
                </div>
                <!-- 3rd Row: Card Details -->
                <div class="row mb-1">
                <label>Card Details</label>
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Card Number" id="card" name="card" maxlength="16">
                            <label for="card">Card Number</label>
                            <img src="" alt="Card Type" id="cardImg" class="position-absolute top-0 end-0 mt-2 me-2" style="max-height: 30px; display: none;">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Name on Card" id="cName" name="cName">
                            <label for="cName">Name on Card</label>
                        </div>
                    </div>
                </div>
                <img src="img/WeAccept-Img.jpg" alt="WeAccept-Img.jpg" class="acceptImg" width="175px" height="40px">
                <!-- 4th Row: Expiration Date -->
                <div class="row mb-1">
                <label>Expiration Date*</label>
                    <div class="col-sm">
                        <select class="form-select" placeholder="Month" id="month" name="month">
                            <option disabled selected>Month</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <select class="form-select" placeholder="Year*" id="year" name="year">
                            <option disabled selected>Year</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="CVV/CVC" id="cvv" name="cvv" maxlength="3">
                            <label for="cvv">CVV/CVC</label>
                        </div>
                    </div>
                </div>
    
                <div class="btnCenter">
                    <button type="reset" class="btn btn-dark me-4">Cancel</button>
                    <button type="submit" class="btn btn-dark ms-4">Signup</button>
                </div>
            </form>
        </div>

        <!-- import the validate.js file before waiting for the DOM content to load -->
        <script src="./js/validate.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function()
            {
                // Format user's phone number as they type
                document.getElementById('phone').addEventListener('input', function(event)
                {
                    // Removes non-numeric characters
                    let phone = event.target.value.replace(/\D/g, '').substring(0, 10);
                    // Formats phone number as 123-456-7890
                    let formatPhone = phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                    event.target.value = formatPhone;
                });

        // _________________________________________________________________________________________________________________________

                // Figure out what card type the user has
                // We only accept Visa, Mastercard, Discover, and American Express
                document.getElementById('card').addEventListener('input', function()
                {
                    let cleanedCard = this.value.replace(/\D/g, '');

                    let cardPattern = 
                    {
                        visa: /^4/,
                        mastercard: /^5[1-5]/,
                        discover: /^6(?:011|5[0-9]{2})/,
                        amex: /^3[47]/
                    };

                    let cardType = '';
                    for (let type in cardPattern)
                    {
                        if (cardPattern[type].test(cleanedCard))
                        {
                            cardType = type;
                            break;
                        }
                    }

                    let formatCard;
                    if (cardType === 'visa' || cardType === 'mastercard' || cardType === 'discover')
                    {
                        formatCard = cleanedCard.match(/.{1,4}/g).join('');
                        document.getElementById('cvv').setAttribute('maxlength', '3');
                    }
                    else if (cardType === 'amex' || cleanedCard.length === 15)
                    {
                        formatCard = cleanedCard.match(/.{1,4}/g).join('');
                        document.getElementById('card').setAttribute('maxlength', '15');
                        document.getElementById('cvv').setAttribute('maxlength', '4');
                    }
                    else
                    {
                        formatCard = cleanedCard;
                    }

                    this.value = formatCard;

                    let cardImg = document.getElementById('cardImg');
                    if (cardImg !== '' && cardType === 'visa')
                    {
                        cardImg.src = 'img/Visa-Img.jpg';
                        cardImg.style.display = 'inline-block';
                    }
                    else if (cardImg !== '' && cardType === 'mastercard')
                    {
                        cardImg.src = 'img/MasterCard-Img.jpg';
                        cardImg.style.display = 'inline-block';
                    }
                    else if (cardImg !== '' && cardType === 'discover')
                    {
                        cardImg.src = 'img/Discover-Img.jpg';
                        cardImg.style.display = 'inline-block';
                    }
                    else if (cardImg !== '' && cardType === 'amex')
                    {
                        cardImg.src = 'img/Amex-Img.jpg';
                        cardImg.style.display = 'inline-block';
                    }
                    else
                    {
                        cardImg.src = '';
                        cardImg.style.display = 'none';
                    }
                });

        // _________________________________________________________________________________________________________________________

                // Populate the Month dropdown menu with the full name of all months in a year
                let monthDrop = document.getElementById('month');
                // month.innerHTML = '<option>Month*</option>';
                let months = 
                [
                    "January", "February", "March", "April", "May", "June", 
                    "July", "August", "September", "October", "November", "December"
                ];

                // Create option elements where the displayed text is the month and the value is the respective numeric counterpart
                months.forEach(function(m, i)
                {
                    let opt = document.createElement("option");
                    opt.text = m;
                    opt.value = i + 1;
                    monthDrop.appendChild(opt);
                });

        // _________________________________________________________________________________________________________________________

                // Populate the Year dropdown menu with years ranging from 1900 - Today
                let yearDrop = document.getElementById('year');
                let curYear = new Date().getFullYear();
                let endYear = curYear + 5;

                // Create option elements where both the displayed text and value are the year
                for (let y=2024; y<=endYear; y++)
                {
                    let opt = document.createElement("option");
                    opt.text = y;
                    opt.value = y;
                    yearDrop.appendChild(opt);
                }
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>