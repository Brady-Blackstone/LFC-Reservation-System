<?php
function connectDB()
{
    // for Brady's local server
    $host = "localhost";
    $db ="LFC_DB";
    $user = "phpUser";
    $pwd = "PHPUser@12345";

    // for Grant's local server
    // $host = "localhost";
    // $db ="LFC_DB";
    // $user = "phpUser";
    // $pwd = "PhpUser@1234";

    // for production server
    // $host = "localhost";
    // $db = "u643483751_LFC_DB";
    // $user = "u643483751_jsUser";
    // $pwd = "JSUser@12345";

    $attr = "mysql: host=$host; dbname=$db";
    $opts =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => False
    ];

    try
    {
        $pdo = new PDO($attr, $user, $pwd, $opts);
        return $pdo;
    } catch (PDOException $e)
    {
        throw new Exception($e->getMessage(), (int)$e->getCode());
    }
}