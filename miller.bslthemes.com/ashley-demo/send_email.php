<?php
header("Content-Type: application/json; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// start output buffering to prevent accidental whitespace
ob_start();

$response = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $to      = "youremail@example.com";  // replace with your email
    $subject = "New Contact Form Message from $name";
    $body    = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        $response = ["success" => true];
    } else {
        $response = ["success" => false, "error" => "Mail sending failed"];
    }
} else {
    $response = ["success" => false, "error" => "Invalid request"];
}

// clean output buffer, ensure only JSON is sent
ob_end_clean();
echo json_encode($response);
exit;
