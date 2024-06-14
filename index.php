<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Application</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
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
        <input type="text" id="search" placeholder="Search articles...">
        <select id="sort-date">
            <option value="desc">New Article</option>
            <option value="asc">Old Article</option>
        </select>
        <div id="articles">
    <table class="article-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->prepare("SELECT * FROM articles ORDER BY created_at DESC");
            $stmt->execute();
            $articles = $stmt->fetchAll();

            foreach ($articles as $article) {
                echo "<tr>";
                echo "<td>{$article['title']}</td>";
                echo "<td>{$article['description']}</td>";
                echo "<td>{$article['category']}</td>";
                echo "<td>{$article['created_at']}</td>";
                echo "<td><a href='edit_article.php?id={$article['id']}'>Edit</a> | <a href='delete_article.php?id={$article['id']}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

    </div>

    <footer>
        <p>Blog Application &copy; 2024  | Developed by Ankit</p>
    </footer>
</body>
</html>
