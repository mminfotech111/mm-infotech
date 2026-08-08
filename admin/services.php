<?php

session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

/* DELETE SERVICE */

if (isset($_GET["delete"])) {

    $id = (int) $_GET["delete"];

    $stmt = $pdo->prepare(
        "DELETE FROM services WHERE id = ?"
    );

    $stmt->execute([$id]);

    header("Location: services.php");
    exit;
}


/* ADD SERVICE */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $service_name = trim($_POST["service_name"]);
    $description = trim($_POST["description"]);
    $icon = trim($_POST["icon"]);

    if ($service_name !== "") {

        $stmt = $pdo->prepare(
            "INSERT INTO services
            (service_name, description, icon)
            VALUES (?, ?, ?)"
        );

        $stmt->execute([
            $service_name,
            $description,
            $icon
        ]);
    }

    header("Location: services.php");
    exit;
}


/* GET SERVICES */

$stmt = $pdo->query(
    "SELECT * FROM services ORDER BY id DESC"
);

$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Manage Services | MM INFOTECH</title>

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
    max-width: 1100px;
    margin: 40px auto;
    padding: 20px;
}

.form-box {
    background: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;

    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.form-box h2 {
    margin-bottom: 20px;
}

input,
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;

    border: 1px solid #ddd;
    border-radius: 6px;
}

textarea {
    height: 100px;
    resize: vertical;
}

button {
    background: #1565c0;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    cursor: pointer;
}

.services {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.service {
    background: white;
    padding: 25px;
    border-radius: 12px;

    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.service-icon {
    font-size: 40px;
    margin-bottom: 10px;
}

.service h3 {
    margin-bottom: 10px;
}

.service p {
    color: #666;
    margin-bottom: 15px;
}

.delete {
    background: #d32f2f;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
}

@media(max-width: 768px) {

    .services {
        grid-template-columns: 1fr;
    }

}

</style>

</head>

<body>

<header class="header">

    <h2>MM INFOTECH</h2>

    <a href="dashboard.php">
        ← Dashboard
    </a>

</header>


<div class="container">

    <div class="form-box">

        <h2>➕ Add New Service</h2>

        <form method="POST">

            <input
                type="text"
                name="service_name"
                placeholder="Service Name"
                required
            >

            <textarea
                name="description"
                placeholder="Service Description"
            ></textarea>

            <input
                type="text"
                name="icon"
                placeholder="Icon / Emoji e.g. 📜"
            >

            <button type="submit">
                Add Service
            </button>

        </form>

    </div>


    <h2 style="margin-bottom:20px;">
        Existing Services
    </h2>


    <div class="services">

        <?php foreach ($services as $service): ?>

        <div class="service">

            <div class="service-icon">
                <?= htmlspecialchars($service["icon"]) ?>
            </div>

            <h3>
                <?= htmlspecialchars($service["service_name"]) ?>
            </h3>

            <p>
                <?= htmlspecialchars($service["description"]) ?>
            </p>

            <a
    href="edit_service.php?id=<?= $service["id"] ?>"
    style="
        display:inline-block;
        background:#1565c0;
        color:white;
        padding:8px 15px;
        border-radius:5px;
        text-decoration:none;
        margin-right:5px;
    "
>
    ✏️ Edit
</a>

<a
    class="delete"
    href="services.php?delete=<?= $service["id"] ?>"
    onclick="return confirm('Delete this service?')"
>
    🗑️ Delete
</a>

        </div>

        <?php endforeach; ?>

    </div>

</div>

</body>

</html>