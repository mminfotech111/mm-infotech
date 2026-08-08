<?php

session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if ($id <= 0) {
    header("Location: services.php");
    exit;
}


/* UPDATE SERVICE */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $service_name = trim($_POST["service_name"]);
    $description = trim($_POST["description"]);
    $icon = trim($_POST["icon"]);

    if ($service_name !== "") {

        $stmt = $pdo->prepare(
            "UPDATE services
             SET service_name = ?,
                 description = ?,
                 icon = ?
             WHERE id = ?"
        );

        $stmt->execute([
            $service_name,
            $description,
            $icon,
            $id
        ]);

        header("Location: services.php");
        exit;
    }
}


/* GET SERVICE */

$stmt = $pdo->prepare(
    "SELECT * FROM services WHERE id = ?"
);

$stmt->execute([$id]);

$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    die("Service not found.");
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Edit Service | MM INFOTECH</title>

<style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f7fb;
}

.header {
    background: #1565c0;
    color: white;
    padding: 20px 30px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header a {
    color: #1565c0;
    background: white;
    padding: 10px 18px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
}

.container {
    max-width: 700px;
    margin: 50px auto;
    padding: 20px;
}

.form-box {
    background: white;
    padding: 35px;
    border-radius: 15px;

    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
}

.form-box h2 {
    margin-bottom: 25px;
}

label {
    display: block;
    margin-bottom: 7px;
    font-weight: bold;
}

input,
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;

    border: 1px solid #ddd;
    border-radius: 6px;

    font-size: 15px;
}

textarea {
    height: 130px;
    resize: vertical;
}

button {
    background: #1565c0;
    color: white;
    border: none;

    padding: 13px 25px;

    border-radius: 6px;

    cursor: pointer;

    font-size: 15px;
    font-weight: bold;
}

.cancel {
    display: inline-block;
    margin-left: 10px;

    padding: 12px 20px;

    border-radius: 6px;

    background: #777;
    color: white;

    text-decoration: none;
}

</style>

</head>

<body>


<header class="header">

    <h2>MM INFOTECH</h2>

    <a href="services.php">
        ← Services
    </a>

</header>


<div class="container">

    <div class="form-box">

        <h2>✏️ Edit Service</h2>

        <form method="POST">

            <label>
                Service Name
            </label>

            <input
                type="text"
                name="service_name"
                value="<?= htmlspecialchars($service["service_name"]) ?>"
                required
            >


            <label>
                Description
            </label>

            <textarea
                name="description"
            ><?= htmlspecialchars($service["description"]) ?></textarea>


            <label>
                Icon / Emoji
            </label>

            <input
                type="text"
                name="icon"
                value="<?= htmlspecialchars($service["icon"]) ?>"
            >


            <button type="submit">
                💾 Update Service
            </button>

            <a
                href="services.php"
                class="cancel"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

</body>

</html>