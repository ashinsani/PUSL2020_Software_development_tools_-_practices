<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Articles</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eee;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-title {
            color: #4b2e83;
        }
        .card-header, .card-footer {
            background-color: #6c5ce7;
            color: white;
        }
 
    </style>
</head>
<body>  
<link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/login.css">
<?php include 'nav.php'; ?>

    <div class="container">
        <h1 class="text-center text-muted mb-4">Articles Home</h1>

        <?php
       
            $host = 'localhost';
            $db = 'nsbm_property';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

          
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                $pdo = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }

     
            $stmt = $pdo->query('SELECT * FROM article');

            if($stmt->rowCount() > 0) {
               
                while ($article = $stmt->fetch()) {
                    echo '<div class="card">';
                    echo '<div class="card-header">Article #' . htmlspecialchars($article['ArticleId']) . '</div>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($article['Title']) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($article['Content']) . '</p>';
                    echo '</div>';
                    echo '<div class="card-footer">Posted on ' . htmlspecialchars($article['CreatedAt']) . '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">No articles found.</p>';
            }
        ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
