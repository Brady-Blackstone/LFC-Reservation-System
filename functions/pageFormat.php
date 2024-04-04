<?php

echo "<link rel=\"stylesheet\" href=\"../css/styles.css\">";

function pageHeader($logo, $arr)
{
    echo "<img src=\"$logo\" alt=\"$logo\" width=\"125\" height=\"125\">";

    foreach($arr as $item)
    {
        if ($item == "Home")
        {
            $mLink = "index.php";
            echo "<a href=\"$mLink\"><span class=\"m-4\"></span>$item</a>";
        }
        else
        {
            $mLink = $item.".php";
            echo "<a href=\"$mLink\"><span class=\"m-4\"></span>$item</a>";
        }
    }
}