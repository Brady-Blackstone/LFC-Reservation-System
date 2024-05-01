<?php
session_start();
header('Content-Type: application/json');

require_once '../functions/dbFuncs.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'error' => 'User not authenticated']);
    exit;
}

$userID = $_SESSION['user'];
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

switch ($action) {
    case 'bookData':
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($date) {
            $result = bookData($userID, $date);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'error' => 'Date parameter is missing']);
        }
        break;

    case 'editData':
        $reservationId = filter_input(INPUT_POST, 'reservationId', FILTER_SANITIZE_NUMBER_INT);
        $newDate = filter_input(INPUT_POST, 'newDate', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($reservationId && $newDate) {
            echo json_encode(editData($userID, $reservationId, $newDate));
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing reservation ID or new date']);
        }
        break;
        case 'cancelData':
            $reservationId = filter_input(INPUT_POST, 'reservationId', FILTER_SANITIZE_NUMBER_INT);
            if ($reservationId) {
                echo json_encode(cancelReservation($userID, $reservationId));
            } else {
                echo json_encode(['success' => false, 'error' => 'Reservation ID is missing']);
            }
        break;
    default:
        echo json_encode(['success' => false, 'error' => 'Action not supported']);
        break;

    
}
exit();

function bookData($user, $date) {
    $pdo = connectDB();
    if (!$pdo) {
        return ['success' => false, 'error' => 'Database connection failed'];
    }
    try {
        $msql = "SELECT MEMBER_ID FROM MEMBERS WHERE USERNAME = ?";
        $mstmt = $pdo->prepare($msql);
        $mstmt->execute([$user]);
        $mid = $mstmt->fetchColumn();

        if (!$mid) {
            return ['success' => false, 'error' => 'User not found'];
        }

        $rsql = "INSERT INTO RESERVATIONS (MEMBER_ID, CUR_DATE, TRANS_TYPE) VALUES (?, ?, 'BOOK')";
        $rstmt = $pdo->prepare($rsql);
        $rstmt->execute([$mid, $date]);

        return ['success' => true, 'message' => 'Reservation booked successfully'];
    } catch (PDOException $e) {
        error_log("PDOException: " . $e->getMessage());
        return ['success' => false, 'error' => 'Failed to book reservation: ' . $e->getMessage()];
    }
}

function editData($user, $reservationId, $newDate) {
    $pdo = connectDB();
    if (!$pdo) {
        return ['success' => false, 'error' => 'Database connection failed'];
    }
    try {
        // Verify the reservation exists and belongs to the user
        $checkSql = "SELECT COUNT(*) FROM RESERVATIONS WHERE RESERVATION_ID = ?;";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$reservationId]);
        $rowCount = $checkStmt->fetchColumn();

        if ($rowCount == 0) {
            return ['success' => false, 'error' => 'Reservation not found or access denied'];
        }

        // Update the reservation with the new date
        $updateSql = "UPDATE RESERVATIONS SET CUR_DATE = ? WHERE RESERVATION_ID = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$newDate, $reservationId]);

        return ['success' => true, 'message' => 'Reservation updated successfully'];
    } catch (PDOException $e) {
        error_log("PDOException: " . $e->getMessage());
        return ['success' => false, 'error' => 'Failed to update reservation: ' . $e->getMessage()];
    }
}

function cancelReservation($user, $reservationId) {
    $pdo = connectDB();
    if (!$pdo) {
        return ['success' => false, 'error' => 'Database connection failed'];
    }
    try {
        // Ensure the reservation exists and belongs to the user
        $checkSql = "SELECT COUNT(*) FROM RESERVATIONS WHERE RESERVATION_ID = ? AND MEMBER_ID = (SELECT MEMBER_ID FROM MEMBERS WHERE USERNAME = ?)";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$reservationId, $user]);
        if ($checkStmt->fetchColumn() == 0) {
            return ['success' => false, 'error' => 'Reservation not found or access denied'];
        }

        // Update the reservation with CANCEL status
        $updateSql = "UPDATE RESERVATIONS SET TRANS_TYPE = 'CANCEL' WHERE RESERVATION_ID = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$reservationId]);

        if ($updateStmt->rowCount() > 0) {
            return ['success' => true, 'message' => 'Reservation canceled successfully'];
        } else {
            return ['success' => false, 'error' => 'Failed to cancel reservation'];
        }
    } catch (PDOException $e) {
        error_log("PDOException: " . $e->getMessage());
        return ['success' => false, 'error' => 'Failed to cancel reservation: ' . $e->getMessage()];
    }
}





