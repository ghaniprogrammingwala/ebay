<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBay Clone - Home</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        .header {
            background-color: #ff6f00;
            color: white;
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
        }
        .header a {
            color: white;
            margin-left: 15px;
            font-size: 1rem;
            text-decoration: none;
        }
        .header a:hover {
            text-decoration: underline;
        }
        .post-ad-btn {
            background-color: white;
            color: #ff6f00;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .post-ad-btn:hover {
            background-color: #fef4e5;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .ads-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .ad {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .ad:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .ad img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 1px solid #e0e0e0;
        }
        .ad-info {
            padding: 15px;
        }
        .ad-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .ad-price {
            color: #ff6f00;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .view-btn {
            display: inline-block;
            background-color: #ff6f00;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }
        .view-btn:hover {
            background-color: #e55d00;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>eBay Clone</h1>
        <div>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
            <button class="post-ad-btn" onclick="window.location.href='post_ad.php'">Post Ad</button>
        </div>
    </div>
    <div class="ads-grid">
        <?php
        $stmt = $conn->query("SELECT * FROM ads ORDER BY created_at DESC");
        while ($ad = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="ad">
                <img src="<?= htmlspecialchars($ad['image_url']) ?>" alt="Ad Image">
                <div class="ad-info">
                    <div class="ad-title"><?= htmlspecialchars($ad['title']) ?></div>
                    <div class="ad-price">$<?= htmlspecialchars($ad['price']) ?></div>
                    <a href="view_ad.php?id=<?= htmlspecialchars($ad['id']) ?>" class="view-btn">View Ad</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
