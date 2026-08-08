<?php

session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | MM INFOTECH</title>

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

        .header h2 {
            font-size: 22px;
        }

        .logout {
            background: white;
            color: #1565c0;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .container {
            padding: 40px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .card .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background: #1565c0;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
        }

        @media(max-width: 768px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px;
            }

        }

    </style>

</head>

<body>

<header class="header">

    <h2>MM INFOTECH ADMIN</h2>

    <a href="logout.php" class="logout">
        Logout
    </a>

</header>


<div class="container">

    <div class="welcome">

        <h1>Welcome, <?= htmlspecialchars($_SESSION["admin_username"]) ?> 👋</h1>

        <p>
            Manage your MM INFOTECH website from here.
        </p>

    </div>


    <div class="cards">

        <div class="card">

            <div class="icon">📋</div>

            <h3>Services</h3>

            <p>
                Add, edit and delete your website services.
            </p>

            <a href="services.php">
                Manage Services
            </a>

        </div>


        <div class="card">

            <div class="icon">📩</div>

            <h3>Messages</h3>

            <p>
                View customer enquiries and messages.
            </p>

            <a href="messages.php">
                View Messages
            </a>

        </div>


        <div class="card">

            <div class="icon">⚙️</div>

            <h3>Settings</h3>

            <p>
                Manage your administrator settings.
            </p>

            <a href="#">
                Settings
            </a>

        </div>

    </div>

</div>

</body>

</html>