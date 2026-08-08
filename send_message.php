<?php

require_once "config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$name = trim($_POST["name"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $phone === "" || $message === "") {
    die("Please fill all required fields.");
}

if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

$stmt = $pdo->prepare(
    "INSERT INTO contacts
    (name, phone, email, message)
    VALUES (?, ?, ?, ?)"
);

$stmt->execute([
    $name,
    $phone,
    $email,
    $message
]);

header("Location: index.php?message=success#contact");
exit;

?>