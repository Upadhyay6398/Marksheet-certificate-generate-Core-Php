<?php
include("../config.php");

header('Content-Type: application/json');

if (!isAjax()) {
    echo json_encode([
        "status" => "error",
        "msg" => "Invalid access"
    ]);
    exit;
}

$email    = sanitizeString($_POST['email'] ?? '');
$password = sanitizeString($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    echo json_encode([
        "status" => "error",
        "msg" => "Email and password are required"
    ]);
    exit;
}

if (login($email, $password) === true) {
    echo json_encode([
        "status" => "success",
        "msg" => "Login successful"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Invalid email or password"
    ]);
}
exit;
