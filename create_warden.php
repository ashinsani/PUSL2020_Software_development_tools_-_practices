<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Listings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">
<style>
       
      
        .form-signin {
            margin-bottom: 15px;
        }
    </style>
    <meta charset="UTF-8">
    <title>Create Student Profile</title>
</head>
<body>
<?php include 'admin_nav.php'; ?>

    <?php


if (isset($_GET['success'])) {
    echo "<div class='alert alert-success' role='alert'>New warden profile created successfully.</div>";
}


?>

<div class="container">
        <h2 class="text-center">Create Warden Profile</h2>
        <form action="create_warden_profile.php" method="post" class="form-signin">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="emailAddress">Email Address:</label>
                <input type="email" id="emailAddress" name="emailAddress" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Profile</button>
        </form>
    </div>
</body>
</html>
