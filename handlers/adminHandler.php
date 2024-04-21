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
        $fsql = "SELECT * FROM FINANCIAL_TRANSACTIONS;";
        $fstmt = $pdo->prepare($fsql);
        $fstmt->execute();
        $fdata = $fstmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch all financial transaction records
        $rsql = "SELECT * FROM RESERVATIONS;";
        $rstmt = $pdo->prepare($rsql);
        $rstmt->execute();
        $rdata = $rstmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch all records in associative array format
        $records = array
        (
            "Financial_Records" => $fdata,
            "Reservation_Records" => $rdata
        );

        $pdo = null;

        return $records;
    } catch (PDOException $e)
    {
        error_log("PODException: ".$e->getMessage());
        $_SESSION['errMsg'] = "No financial records found.";
        return [];
    }
}