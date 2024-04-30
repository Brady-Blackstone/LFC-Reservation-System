<?php
session_start();
require_once '../functions/dbFuncs.php';

// Get the user that is currently logged in
$userID = $_SESSION['user'];

// Validate and sanitize the action parameter
$action = isset($_GET['action']) ? $_GET['action'] : '';
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

// Check if the action is 'fetchData'
if ($action === 'fetchData') 
{
    // Call the fetchFinTrans function
    $data = fetchData($userID);
    // Return the data as JSON
    echo json_encode($data);
    exit;
}

function fetchData($user)
{
    try
    {
        // Connect to the database
        $pdo = connectDB();

        // Fetch all member records
        $msql = "SELECT MEMBER_ID FROM MEMBERS WHERE USERNAME = ?;";
        $mstmt = $pdo->prepare($msql);
        $mstmt->execute([$user]);
        $mid = $mstmt->fetchColumn();

        // Fetch all reservations records
        $rsql = "SELECT * FROM RESERVATIONS WHERE MEMBER_ID = ?;";
        $rstmt = $pdo->prepare($rsql);
        $rstmt->execute([$mid]);
        $records = $rstmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;

        return $records;
    } catch (PDOException $e)
    {
        error_log("PODException: ".$e->getMessage());
        $_SESSION['errMsg'] = "No reservations found.";
        return [];
    }
}