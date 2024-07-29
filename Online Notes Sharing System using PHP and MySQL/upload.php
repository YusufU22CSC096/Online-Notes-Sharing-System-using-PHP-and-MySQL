<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file = $_FILES['file'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $target_file);

    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO notes (user_id, title, description, file_path) VALUES ('$user_id', '$title', '$description', '$target_file')";

    if (mysqli_query($conn, $sql)) {
        echo "File uploaded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<form method="POST" action="upload.php" enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br>
    Description: <textarea name="description" required></textarea><br>
    File: <input type="file" name="file" required><br>
    <input type="submit" value="Upload">
</form>
