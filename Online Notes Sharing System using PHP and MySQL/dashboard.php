<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notes WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
?>

<h1>Your Notes</h1>

<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>File</th>
        <th>Created At</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><a href="<?php echo $row['file_path']; ?>">Download</a></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
    <?php } ?>
</table>

<a href="upload.php">Upload New Note</a>
