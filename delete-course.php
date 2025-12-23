<?php
include("config.php");
include("lock.php");

$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;

if (empty($id)) {
    $_SESSION['msg'] = "Invalid course ID.";
    $_SESSION['msg_type'] = "error";
    header("Location: manage-course.php");
    exit();
}

try {
    // Check if course exists
    $course = $DB->getRowById('course', $id);
    
    if (!$course) {
        $_SESSION['msg'] = "Course not found.";
        $_SESSION['msg_type'] = "error";
        header("Location: manage-course.php");
        exit();
    }



$sql = "SELECT COUNT(*) FROM marksheet WHERE course_id = ?";
$stmt = $DB->DB->prepare($sql);
$stmt->execute([$id]);
$usageCount = (int) $stmt->fetchColumn();

if ($usageCount > 0) {
    $_SESSION['msg'] = "Cannot delete this course. It is used in {$usageCount} marksheet(s).";
    $_SESSION['msg_type'] = "error";
    header("Location: manage-course.php");
    exit();
}


    // Delete the course
    $res = $DB->delete('course', $id);

    if ($res) {
        $_SESSION['msg'] = "Course deleted successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "Failed to delete course.";
        $_SESSION['msg_type'] = "error";
    }
} catch (Exception $e) {
    $_SESSION['msg'] = "Error: " . $e->getMessage();
    $_SESSION['msg_type'] = "error";
}

header("Location: manage-course.php");
exit();
?>
