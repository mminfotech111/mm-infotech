<?php

require_once "config/database.php";

$stmt = $pdo->query(
    "SELECT * FROM services ORDER BY id DESC"
);

$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MM INFOTECH | Online Services</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="header">

    <div class="logo">
        <span>MM</span> INFOTECH
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="#services">Services</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
    </nav>

</header>


<section class="hero">

    <div class="hero-content">

        <p class="small-title">WELCOME TO MM INFOTECH</p>

        <h1>
            Your Trusted
            <span>Online Service</span>
            Center
        </h1>

        <p>
            Government certificates, online applications,
            printing, scanning, documentation and digital services
            — all in one place.
        </p>

        <div class="buttons">

            <a href="#services" class="btn primary">
                Our Services
            </a>

            <a href="#contact" class="btn secondary">
                Contact Us
            </a>

        </div>

    </div>

</section>


<section id="services" class="services">

    <div class="section-title">

        <p>WHAT WE OFFER</p>

        <h2>Our Services</h2>

        <span>
            Fast, reliable and convenient digital services.
        </span>

    </div>


    <div class="service-container">

    <?php if (count($services) > 0): ?>

        <?php foreach ($services as $service): ?>

            <div class="service-card">

                <div class="icon">
                    <?= htmlspecialchars($service["icon"]) ?>
                </div>

                <h3>
                    <?= htmlspecialchars($service["service_name"]) ?>
                </h3>

                <p>
                    <?= htmlspecialchars($service["description"]) ?>
                </p>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p>
            Our services will be updated soon.
        </p>

    <?php endif; ?>

</div>

</section>


<section id="about" class="about">

    <div>

        <p class="small-title">ABOUT US</p>

        <h2>MM INFOTECH</h2>

        <p>
            MM INFOTECH provides convenient digital,
            documentation and online services to customers.
            Our goal is to make online services simple,
            fast and accessible.
        </p>

    </div>

</section>


<section id="contact" class="contact">


<div class="section-title">

        <p>GET IN TOUCH</p>

        <h2>Contact Us</h2>

        <span>
            Have a question? Send us a message.
        </span>

    </div>


    <div class="contact-form">

        <form method="POST" action="send_message.php">

            <input
                type="text"
                name="name"
                placeholder="Your Name"
                required
            >

            <input
                type="tel"
                name="phone"
                placeholder="Mobile Number"
                required
            >

            <input
                type="email"
                name="email"
                placeholder="Email Address"
            >

            <textarea
                name="message"
                placeholder="Write your message..."
                required
            ></textarea>

            <button type="submit">
                Send Message
            </button>

        </form>

    </div>
<div class="contact-box">

    <p>📍 Arni, Tamil Nadu</p>

    <p>📞 +91 7010604698</p>

    <p>✉️ mminfotech101@gmail.com</p>

    <p>🕘 Monday – Saturday: 9:00 AM – 8:00 PM</p>

</div>    
<div class="map-container">

    <iframe
        src="YOUR_GOOGLE_MAPS_EMBED_URL"
        width="100%"
        height="350"
        style="border:0;"
        loading="lazy">
    </iframe>

</div>
<img
    src="images/logo.png"
    alt="MM INFOTECH Logo"
    class="logo-image"
>

</section>


<footer>

    <p>
        © 2026 MM INFOTECH. All Rights Reserved.
    </p>

</footer>

<!-- Floating Contact Buttons -->

<div class="floating-contact">

    <a
        href="tel:+919876543210"
        class="call-button"
        title="Call MM INFOTECH"
    >
        📞
    </a>

    <a
        href="https://wa.me/917010604698?text=Hello%20MM%20INFOTECH,%20I%20need%20your%20online%20service."
        class="whatsapp-button"
        target="_blank"
        rel="noopener"
        title="WhatsApp MM INFOTECH"
    >
        💬
    </a>

</div>
</body>
</html>