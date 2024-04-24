<?php
session_start();
require_once '../functions/dbFuncs.php';

// Get the user that is currently logged in
$userID = $_SESSION['user'];

// Connect to the database and prevent SQL injection by preparing a statement without any user's personal data
$pdo = connectDB();

try
{
    $sql = $sql = "UPDATE MEMBERS SET STATUS = \"DEACTIVATED\" WHERE USERNAME = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID]);

    // Send an error message over to the Profile page if the deactivation was unsuccessful
    if ($stmt->rowCount() == 0) 
    {
        $_SESSION['errMsg'] = "Error: Unable to delete account";
        header("Location: ../Profile.php");
        exit();
    }
    // Log the newly made guest out and send them back to the home page
    else
    {
        $_SESSION = array();
        setcookie(session_name(), "", time()-2592000, "/");
        session_destroy();

        header("Location: ../index.php");
        exit();
    }
} catch (PDOException $e)
{
    // Send an error message over to the Profile page if the deactivation was unsuccessful
    error_log("PODException: ".$e->getMessage());
    $_SESSION['errMsg'] = "Error: ".$e->getMessage();
    header("Location: ../Profile.php");
    exit();
}