<?php 
include 'db.php'; 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url']; // In production, this would handle actual image uploads.
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO ads (user_id, title, description, price, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $description, $price, $image_url]);

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Ad</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .form-container h1 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }
        input[type="text"], input[type="number"], input[type="url"], textarea, button {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="text"]:hover, input[type="number"]:hover, input[type="url"]:hover, textarea:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input[type="text"]:focus, input[type="number"]:focus, input[type="url"]:focus, textarea:focus {
            outline: none;
            border-color: #ff6f00;
            box-shadow: 0 0 10px rgba(255, 111, 0, 0.5);
        }
        textarea {
            resize: none;
            height: 100px;
        }
        button {
            background-color: #ff6600;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background-color: #e55d00;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(229, 93, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Post an Ad</h1>
        <form method="POST">
            <input type="text" name="title" placeholder="Ad Title" required>
            <textarea name="description" placeholder="Ad Description" required></textarea>
            <input type="number" name="price" placeholder="Price" required>
            <input type="url" name="image_url" placeholder="Image URL" required>
            <button type="submit">Post Ad</button>
        </form>
    </div>
</body>
</html>
