<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Blog Application</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="create_article.php">Create Article</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Edit Article</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt = $conn->prepare("SELECT * FROM articles WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $article = $stmt->fetch();

            if ($article) {
                echo "<form action='edit_article.php?id={$id}' method='post'>";
                echo "<label for='title'>Title</label>";
                echo "<input type='text' name='title' value='{$article['title']}' required>";
                echo "<label for='description'>Description</label>";
                echo "<textarea name='description' required>{$article['description']}</textarea>";
                echo "<label for='category'>Category</label>";
                echo "<input type='text' name='category' value='{$article['category']}' required>";
                echo "<label for='slug'>Slug</label>";
                echo "<input type='text' name='slug' value='{$article['slug']}' required>";
                echo "<input type='submit' name='submit' value='Update Article'>";
                echo "</form>";
            }
        }

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $slug = $_POST['slug'];

            $stmt = $conn->prepare("UPDATE articles SET title = :title, description = :description, category = :category, slug = :slug WHERE id = :id");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':slug', $slug);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo "Article updated successfully!";
            } else {
                echo "Error updating article.";
            }
        }
        ?>
    </div>

    <footer>
        <p>Blog Application &copy; 2024</p>
    </footer>
</body>
</html>
