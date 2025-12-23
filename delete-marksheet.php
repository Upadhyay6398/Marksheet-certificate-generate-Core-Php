<?php
include("config.php");
include("lock.php");

$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;

if (empty($id)) {
    $_SESSION['msg'] = "Invalid marksheet ID.";
    $_SESSION['msg_type'] = "error";
    header("Location: manage-marksheet.php");
    exit();
}

try {
    // Check if marksheet exists
    $marksheet = $DB->getRowById('marksheet', $id);
    
    if (!$marksheet) {
        $_SESSION['msg'] = "Marksheet not found.";
        $_SESSION['msg_type'] = "error";
        header("Location: manage-marksheet.php");
        exit();
    }

    // Delete the marksheet
    $res = $DB->delete('marksheet', $id);

    if ($res) {
        $_SESSION['msg'] = "Marksheet deleted successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "Failed to delete marksheet.";
        $_SESSION['msg_type'] = "error";
    }
} catch (Exception $e) {
    $_SESSION['msg'] = "Error: " . $e->getMessage();
    $_SESSION['msg_type'] = "error";
}

header("Location: manage-marksheet.php");
exit();
?>

