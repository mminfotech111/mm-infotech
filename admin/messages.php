<?php

session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

if (isset($_GET["delete"])) {

    $id = (int) $_GET["delete"];

    $stmt = $pdo->prepare(
        "DELETE FROM contacts WHERE id = ?"
    );

    $stmt->execute([$id]);

    header("Location: messages.php");
    exit;
}

$stmt = $pdo->query(
    "SELECT * FROM contacts ORDER BY id DESC"
);

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Customer Messages | MM INFOTECH</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
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
    background: white;
    color: #1565c0;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
}

.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
}

.message {
    background: white;
    margin-bottom: 20px;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.message h3 {
    margin-bottom: 10px;
}

.message p {
    margin: 8px 0;
}

.delete {
    display: inline-block;
    margin-top: 12px;
    padding: 8px 15px;
    background: #d32f2f;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.empty {
    background: white;
    padding: 30px;
    text-align: center;
    border-radius: 10px;
}

</style>

</head>

<body>

<header class="header">

    <h2>Customer Messages</h2>

    <a href="dashboard.php">
        ← Dashboard
    </a>

</header>


<div class="container">

<?php if (count($messages) > 0): ?>

    <?php foreach ($messages as $message): ?>

        <div class="message">

            <h3>
                👤 <?= htmlspecialchars($message["name"]) ?>
            </h3>

            <p>
                📞 <?= htmlspecialchars($message["phone"]) ?>
            </p>

            <?php if (!empty($message["email"])): ?>

                <p>
                    📧 <?= htmlspecialchars($message["email"]) ?>
                </p>

            <?php endif; ?>

            <p>
                📝 <?= nl2br(
                    htmlspecialchars($message["message"])
                ) ?>
            </p>

            <p>
                <small>
                    <?= htmlspecialchars($message["created_at"]) ?>
                </small>
            </p>

            <a
                class="delete"
                href="messages.php?delete=<?= $message["id"] ?>"
                onclick="return confirm('Delete this message?')"
            >
                🗑️ Delete
            </a>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <div class="empty">
        📭 No customer messages yet.
    </div>

<?php endif; ?>

</div>

</body>

</html>