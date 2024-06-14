<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM articles WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Article deleted successfully!";
    } else {
        echo "Error deleting article.";
    }
}

header("Location: index.php");
exit();
?>
