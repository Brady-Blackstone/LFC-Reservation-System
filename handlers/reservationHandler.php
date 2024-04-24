<?php
session_start();
require_once '../functions/dbFuncs.php';

// Validate and sanitize the action parameter
$action = isset($_GET['action']) ? $_GET['action'] : '';
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

// Check if the action is 'fetchData'
if ($action === 'fetchData') 
{
    // Call the fetchFinTrans function
    $data = fetchData();
    // Return the data as JSON
    echo json_encode($data);
    exit;
}

function fetchData()
{
    try
    {
        // Connect to the database
        $pdo = connectDB();

        // Fetch all financial transaction records
        $sql = "SELECT * FROM RESERVATIONS;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;

        return $records;
    } catch (PDOException $e)
    {
        error_log("PODException: ".$e->getMessage());
        $_SESSION['errMsg'] = "No reservations found.";
        return [];
    }
}