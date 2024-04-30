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
        $sql = "SELECT * FROM MEMBERS WHERE USERNAME = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;

        return $records;
    } catch (PDOException $e)
    {
        error_log("PODException: ".$e->getMessage());
        $_SESSION['errMsg'] = "Profile not found.";
        return [];
    }
}