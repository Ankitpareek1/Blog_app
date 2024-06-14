<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Article</title>
    <link rel="stylesheet" href="css/styles.css">
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
        <h1>Create Article</h1>
        <form action="create_article.php" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" required>
            <label for="description">Description</label>
            <textarea name="description" required></textarea>
            <label for="category">Category</label>
            <input type="text" name="category" required>
            <label for="slug">Slug</label>
            <input type="text" name="slug" required>
            <input type="submit" name="submit" value="Create Article">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $slug = $_POST['slug'];

            $stmt = $conn->prepare("INSERT INTO articles (title, description, category, slug) VALUES (:title, :description, :category, :slug)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':slug', $slug);

            if ($stmt->execute()) {
                echo "Article created successfully!";
            } else {
                echo "Error creating article.";
            }
        }
        ?>
    </div>

    <footer>
        <p>Blog Application &copy; 2024 | Developed by Ankit</p>
    </footer>
</body>
</html>
