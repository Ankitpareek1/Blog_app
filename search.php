<?php
include 'db.php';

$query = isset($_POST['query']) ? $_POST['query'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'desc';

$sql = "SELECT * FROM articles WHERE title LIKE :query OR description LIKE :query ORDER BY created_at $sort";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':query', '%' . $query . '%');
$stmt->execute();
$articles = $stmt->fetchAll();

foreach ($articles as $article) {
    echo "<div class='article'>";
    echo "<h2>{$article['title']}</h2>";
    echo "<p>{$article['description']}</p>";
    echo "<small>Category: {$article['category']} | Created at: {$article['created_at']}</small>";
    echo "<br><a href='edit_article.php?id={$article['id']}'>Edit</a> | <a href='delete_article.php?id={$article['id']}'>Delete</a>";
    echo "</div>";
}
?>
