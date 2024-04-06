<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rates | littlefishingcreek</title>
        
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
        pageHeader("Rates", $arr);
        ?>

        <h2>Daily Golf Fees</h2>

        <p>
            The Little Fishing Creek Golf Course offers green and cart fees that are highly competitive and reasonably affordable. 
            We only accept tee time reservations on weekends and holidays, if you would like to make a reservation please call at 
            (478) 445-0796 or visit the Contact Us page.
        </p>

        <h3>Daily Fees</h3>

        <br><br>

        <table>
            <caption>Green Fees</caption>
            <thead>
                <tr>
                    <th class="rotate">Weekdays</th>
                    <td>$12.50 All Day</td>
                    <td>$10.50 Twilight</td>
                </tr>
                <tr>
                    <th class="rotate">Weekends</th>
                    <td>$15.50 All Day</td>
                    <td>$13.50 Twilight</td>
                </tr>
                <tr>
                    <th class="rotate">Holidays</th>
                    <td>$15.50 All Day</td>
                    <td>$13.50 Twilight</td>
                </tr>
            </thead>
        </table>

        <br><br><br>
        
        <table>
            <caption>Cart Fees</caption>
            <thead>
                <tr>
                    <th class="rotate">Nine Holes</th>
                    <td>$8.00 Each</td>
                    <td>Trail Fee $7.50</td>
                </tr>
                <tr>
                    <th class="rotate">Eighteen Holes</th>
                    <td>$12.00 Each</td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="3">**All of these prices are subject to a 7% sales tax**</th>
                </tr>
            </tfoot>
        </table>

        <br><br>

        <h3>Annual Green Fees</h3>

        <br>

        <table>
            <tr>
                <th class="rotate">High School & Under</th>
                <td>$150.00 Summer</td>
                <td>$150.00 School Year</td>
            </tr>
            <tr>
                <th class="rotate">Junior (20 & Under)</th>
                <td>$400.00</td>
            </tr>
            <tr>
                <th class="rotate">Single</th>
                <td>$500.00</td>
            </tr>
            <tr>
                <th class="rotate">Family</th>
                <td>$500.00 1st Semester</td>
                <td>$225.00 Each Additional</td>
            </tr>
            <tr>
                <th class="rotate">Senior</th>
                <td>$400.00</td>
            </tr>
            <tr>
                <th class="rotate">Senior Family</th>
                <td>$225.00 Each Additional</td>
            </tr>
            <tfoot>
                <tr>
                    <th colspan="6">**Tee times are encouraged on Weekends and Holidays**</th>
                </tr>
                <tr>
                    <th colspan="6">**Golf Shop phone # 478-445-0796**</th>
                </tr>
            </tfoot>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
                crossorigin="anonymous">
        </script>
    </body>
</html>