<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Design</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .design-container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 16px;
            margin-top: 10px;
        }
        input[type="text"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="design-container">
        <h2>Add Your Design</h2>
        <form action="add-design.php" method="post" enctype="multipart/form-data">
            <label for="title">Design Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="image">Upload Design Image:</label>
            <input type="file" id="image" name="image" required>

            <label for="description">Design Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <input type="submit" value="Add Design">
        </form>
    </div>
</body>
</html>
