<?php
session_start();
require_once '../functions/dbFuncs.php';

// Check if the user entered in all credentials
if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['userID']) || empty($_POST['pwd']) || empty($_POST['cpwd']) || empty($_POST['phone']) || empty($_POST['email'])) 
{
    $_SESSION['errMsg'] = "Error: Username and password are required.";
    header("Location: ../Login.php");
    exit();
}

// Get the form values from the signup page located in the Signup.php file
$userID = $_POST['userID'];
$pwd = $_POST['pwd'];
$cpwd = $_POST['cpwd'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Sanitize input by trimming any whitespace that may be in the input fields
$userID = trim($userID);
$pwd = trim($pwd);
$cpwd = trim($cpwd);
$fname = trim($fname);
$lname = trim($lname);
$phone = trim($phone);
$email = trim($email);

// Everything below before hashing the password is to sanitize a user's input

// If both passwords do not match, stop further execution
if ($pwd !== $cpwd)
{
    $_SESSTION["errMsg"] = "Error: Passwords do not match!";
    header("Location: ../Signup.php");
    exit();
}

// Validate username
if (!preg_match('/^[a-zA-Z0-9_-]+$/', $userID)) 
{
    // Send an error message if the username contains invalid characters
    $_SESSION['errMsg'] = "Error: Username can only contain alphanumeric characters, underscores, and hyphens";
    header("Location: ../Signup.php");
    exit();
}

// Validate password
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^\s`\'"\\<>%$&+=]{12,}$/', $pwd)) 
{
    // Send an error message if the password doesn't meet the criteria
    $_SESSION['errMsg'] = "Error: Password must be at least 12 characters long and contain at least one uppercase letter, one lowercase letter, one number, and not contain backticks (`), double and single quotes (\" '), backslashes (/), angle brackets (< >), ampersands (&), percent signs (%), dollar signs ($), or plus signs (+)";
    header("Location: ../Signup.php");
    exit();
}

// Validate first name and last name
if (!preg_match('/^[a-zA-Z]+$/', $fname) || !preg_match('/^[a-zA-Z]+$/', $lname)) 
{
    // Send an error message if the first or last name contain non-alphabetic characters
    $_SESSION['errMsg'] = "Error: First Name and Last Name must contain only alphabetic characters";
    header("Location: ../Signup.php");
    exit();
}

// Validate phone number
if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) 
{
    // Send an error message if the phone number is not in XXX-XXX-XXXX format
    $_SESSION['errMsg'] = "Error: Invalid Phone Number, it should be XXX-XXX-XXXX";
    header("Location: ../Signup.php");
    exit();
}

// Validate email address
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    // Send an error message if the email address is invalid
    $_SESSION['errMsg'] = "Error: Invalid Email Address, it should be X@X.X";
    header("Location: ../Signup.php");
    exit();
}

// Hash the password using bcrypt
$pwdH = password_hash($pwd, PASSWORD_BCRYPT);

// Connect to the database and prevent SQL injection by preparing a statement without any user's personal data
$pdo = connectDB();

// Check if the username already exists
$sql = "SELECT COUNT(*) FROM MEMBERS WHERE USERNAME = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userID]);
if ($stmt->fetchColumn() > 0) 
{
    $_SESSION['errMsg'] = "Error: Username already exists";
    header("Location: ../Signup.php");
    exit();
}

// Check if the phone number already exists
$sql = "SELECT COUNT(*) FROM MEMBERS WHERE PHONE_NUM = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$phone]);
if ($stmt->fetchColumn() > 0) 
{
    $_SESSION['errMsg'] = "Error: Phone Number already exists";
    header("Location: ../Signup.php");
    exit();
}

// Check if the email already exists
$sql = "SELECT COUNT(*) FROM MEMBERS WHERE EMAIL = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
if ($stmt->fetchColumn() > 0) 
{
    $_SESSION['errMsg'] = "Error: Email Address already exists";
    header("Location: ../Signup.php");
    exit();
}

$sql = "INSERT INTO MEMBERS (USERNAME, PASSWORD, FIRST_NAME, LAST_NAME, PHONE_NUM, EMAIL, STATUS) 
        VALUES (?, ?, ?, ?, ?, ?, \"ACTIVE\");";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userID, $pwdH, $fname, $lname, $phone, $email]);

// Send an error message over to the Signup page if any of the entered information is invalid
if ($stmt->rowCount() == 0) 
{
    $_SESSION['errMsg'] = "Error: Unable to register, Try again";
    header("Location: ../Signup.php");
    exit();
}
// Send the new member over to the Login page
else
{
    header("Location: ../Login.php");
    exit();
}