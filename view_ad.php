<?php
include 'db.php';
session_start();

// Get ad details
$ad_id = $_GET['id'];
$stmt = $conn->prepare("SELECT ads.*, users.name AS seller_name, users.email AS seller_email FROM ads JOIN users ON ads.user_id = users.id WHERE ads.id = ?");
$stmt->execute([$ad_id]);
$ad = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ad) {
    die("Ad not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($ad['title']) ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .ad-container {
            width: 100%;
            max-width: 600px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .ad-container:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }
        .ad-title {
            font-size: 26px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }
        .ad-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .ad-price {
            color: #ff6600;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
        .contact-seller {
            text-align: center;
        }
        .contact-seller p {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }
        .contact-seller button {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .contact-seller button:hover {
            background-color: #e55d00;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(229, 93, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="ad-container">
        <div class="ad-title"><?= htmlspecialchars($ad['title']) ?></div>
        <img src="<?= htmlspecialchars($ad['image_url']) ?>" alt="Ad Image" class="ad-image">
        <div class="ad-price">$<?= htmlspecialchars($ad['price']) ?></div>
        <p><?= nl2br(htmlspecialchars($ad['description'])) ?></p>
        <div class="contact-seller">
            <p>Seller: <?= htmlspecialchars($ad['seller_name']) ?></p>
            <!-- Dynamic Contact Seller Button -->
            <button onclick="window.location.href='mailto:<?= htmlspecialchars($ad['seller_email']) ?>?subject=Inquiry about <?= htmlspecialchars($ad['title']) ?>'">
                Contact Seller
            </button>
        </div>
    </div>
</body>
</html>
