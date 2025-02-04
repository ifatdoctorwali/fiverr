<?php
// Upload image processing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["gig_image"])) {
    $target_dir = "uploads/";
    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($_FILES["gig_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is actual image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["gig_image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check file size (5MB max)
    if ($_FILES["gig_image"]["size"] > 5000000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gig_image"]["tmp_name"], $target_file)) {
            $success = "Image uploaded successfully!";
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
}

// Function to get all images
function getImages() {
    $images = [];
    $dir = "uploads/";
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if ($file !== '.' && $file !== '..' && in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $images[] = $dir . $file;
            }
        }
    }
    return $images;
}

$images = getImages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiverr Clone</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .header {
            background: white;
            padding: 15px 50px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: #1dbf73;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-login {
            color: #62646a;
            border: 1px solid #62646a;
        }

        .btn-signup {
            background: #1dbf73;
            color: white;
        }

        .welcome-section {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(to right, #1dbf73, #19a463);
            color: white;
            margin-bottom: 30px;
        }

        .welcome-section h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .upload-section {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .upload-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .upload-btn {
            background: #1dbf73;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .message {
            text-align: center;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gig-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .gig-card:hover {
            transform: translateY(-5px);
        }

        .gig-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .gig-details {
            padding: 15px;
        }

        .gig-title {
            font-size: 16px;
            color: #404145;
            margin-bottom: 10px;
        }

        .gig-price {
            color: #1dbf73;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            
            .image-grid {
                padding: 10px;
                gap: 10px;
            }
            
            .upload-section {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="index.php" class="logo">Fiverr Clone</a>
        <div class="nav-buttons">
            <a href="login.php" class="btn btn-login">Sign In</a>
            <a href="signup.php" class="btn btn-signup">Join</a>
        </div>
    </header>

    <div class="welcome-section">
        <h1>Welcome to Fiverr Clone</h1>
        <p>Find the perfect freelance services for your business</p>
    </div>

    <div class="upload-section">
        <form method="POST" enctype="multipart/form-data" class="upload-form">
            <input type="file" name="gig_image" accept="image/*" required>
            <button type="submit" name="submit" class="upload-btn">Upload Image</button>
        </form>
        
        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>

    <div class="image-grid">
        <?php foreach ($images as $image): ?>
            <div class="gig-card">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Gig Image" class="gig-image">
                <div class="gig-details">
                    <div class="gig-title">I will create amazing designs</div>
                    <div class="gig-price">Starting at $5</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
