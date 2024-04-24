<?php
session_start();
require_once '../functions/dbFuncs.php';

// Check if the user entered in all credentials
if (empty($_POST['userID']) || empty($_POST['pwd'])) 
{
    $_SESSION['errMsg'] = "Error: Username and password are required.";
    header("Location: ../Login.php");
    exit();
}

// Get the username and password from the form located in the Login.php file
$userID = $_POST['userID'];
$pwd = $_POST['pwd'];

// Sanitize input by trimming any whitespace that may be in the input fields
$userID = trim($userID);
$pwd = trim($pwd);

// Connect to the database and prevent SQL injection by preparing a statement without any user's personal data
$pdo = connectDB();
$sql = "SELECT * FROM ADMINS WHERE USERNAME = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userID]);

// Check if Admin
if ($stmt->rowCount() > 0) 
{
    // Verify if the entered password matches the hashed password in the database
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($pwd, $admin['PASSWORD']))
    {
        // Start an admin session for the admin
        $_SESSION['admin'] = $userID;
        header("Location: ../Dashboard.php");
        exit();
    }
}

// Check if Member
$sql = "SELECT * FROM MEMBERS WHERE USERNAME = ? AND STATUS = \"ACTIVE\";";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userID]);

if ($stmt->rowCount() > 0)
{
    // Verify if the entered password matches the hashed password in the database
    $member =  $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($pwd, $member['PASSWORD']))
    {
        // Start a user session for the member
        $_SESSION['user'] = $userID;
        header("Location: ../index.php");
        exit();
    }
}

// Send an error message over to the Login page if the admin/member does not exist in the database
// Encode the error messagee before sending it back to the user
$_SESSION['errMsg'] = "Invalid Username or Password, Try again";
header("Location: ../Login.php");
$pdo = null;
exit();