<?php
require("config.php");
require("lock.php");
session_start(); 

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']); 

    if (is_numeric($id)) { 
        $id = intval($id);

        $sql = "DELETE FROM `category` WHERE id = :id";
        $stmt = $DB->DB->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Record deleted successfully.";
            $_SESSION['error'] = "success";
        } else {
            $_SESSION['message'] = "Error deleting record.";
            $_SESSION['error'] = "error";
        }
    } else {
        $_SESSION['message'] = "Invalid ID format.";
        $_SESSION['error'] = "error";
    }
} else {
    $_SESSION['message'] = "ID not provided.";
    $_SESSION['error'] = "error";
}

header('Location: manage-category.php');
exit();
?>
