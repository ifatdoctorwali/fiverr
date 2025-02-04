<?php
// Gig addition logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gig_name'])) {
    $gigName = $_POST['gig_name'];
    // Add the gig to the database or array (For now, we add it to the session or an array)
    // For example, let's save it in session for now:
    session_start();
    if (!isset($_SESSION['gigs'])) {
        $_SESSION['gigs'] = [];
    }
    $_SESSION['gigs'][] = $gigName;
    // Redirect to index.php with success message
    header("Location: index.php?success=Gig added successfully");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Gig</title>
</head>
<body>

<h2>Add Gig</h2>
<form action="add-gig.php" method="post">
    <label for="gig_name">Gig Name:</label>
    <input type="text" name="gig_name" id="gig_name" required>
    <input type="submit" value="Add Gig">
</form>

</body>
</html>
