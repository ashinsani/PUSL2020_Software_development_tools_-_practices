<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Listings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">
</head>
<body>

<?php include 'admin_nav.php'; ?>
<?php
   
    if(isset($_GET['success']) && $_GET['success'] == 'true') {
     
        echo '<div class="alert alert-success" role="alert">
        Article added successfully!
              </div>';
    }
    ?>
    <div class="container mt-5">
        <h2>Post an Article</h2>
        <form action="post_article.php" method="post">
            <div class="form-group">
                <label for="articleTitle">Article Title</label>
                <input type="text" class="form-control" id="articleTitle" name="articleTitle" required>
            </div>
            <div class="form-group">
                <label for="articleContent">Content</label>
                <textarea class="form-control" id="articleContent" name="articleContent" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Article</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
