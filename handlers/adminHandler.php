<?php
session_start();
require_once '../functions/dbFuncs.php';

// Validate and sanitize the action parameter
$action = isset($_GET['action']) ? $_GET['action'] : '';
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

// Check if the action is 'fetchData'
if ($action === 'fetchData') 
{
    $memID = isset($_GET['memID']) ? $_GET['memID'] : null;
    // Call the fetchData function
    $data = fetchData($memID);
    // Return the data as JSON
    echo json_encode($data);
    exit;
}

function fetchData($memID = null)
{
    try
    {
        // Connect to the database
        $pdo = connectDB();

        $fsql = "SELECT * FROM FINANCIAL_TRANSACTIONS";
        $rsql = "SELECT * FROM RESERVATIONS";

        if ($memID !== null) 
        {
            $fsql .= " WHERE MEMBER_ID = :memID";
            $rsql .= " WHERE MEMBER_ID = :memID";
        }

        $fstmt = $pdo->prepare($fsql);
        $rstmt = $pdo->prepare($rsql);

        if ($memID !== null) 
        {
            $fstmt->bindParam(':memID', $memID);
            $rstmt->bindParam(':memID', $memID);
        }

        // Fetch all financial transaction and reservation records
        $fstmt->execute();
        $fdata = $fstmt->fetchAll(PDO::FETCH_ASSOC);

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
        error_log("PDOException: ".$e->getMessage());
        $_SESSION['errMsg'] = "An error occurred while fetching data.";
        return [];
    } catch (Exception $e) 
    {
        error_log("Exception: ".$e->getMessage());
        $_SESSION['errMsg'] = $e->getMessage();
        return [];
    }
}