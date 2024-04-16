<?php
function pageHeader($title, $arr)
{
    echo "<img src=\"./img/LFC-Logo.jpg\" alt=\"./img/LFC-Logo.jpg\" width=\"46\" height=\"72\">";

    echo "<div class=\"nav\">";
    foreach($arr as $item)
    {
        if ($item == "Home")
        {
            $mLink = "index.php";
        }
        elseif ($item == "Admin Page")
        {
            $mLink = "Admin.php";
        }
        elseif ($item == "Contact Us")
        {
            $mLink = "Contact-us.php";
        }
        else
        {
            $mLink = $item.".php";
        }

        // Check if the current item matches the current page
        // If it does, make the class active, else make it empty
        // Then print out the link for the current item
        $class = ($item == $title) ? 'class="active"' : '';
        echo "<a $class href=\"$mLink\">$item</a>";
    }
    echo "</div>";
}