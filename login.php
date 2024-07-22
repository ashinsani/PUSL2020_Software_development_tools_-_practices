<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/login.css">


</head>

</head>
<body>
<?php include 'nav.php'; ?>
<div class="container">
    <div class="login-container">
        <?php
       
        if (isset($_GET['login_failed']) && $_GET['login_failed'] == 'true') {
          
            echo '<div class="alert alert-danger text-center" role="alert">Login failed. Please try again.</div>';
        }
        ?>
        <form action="login_process.php" method="post">
            <div class="form-group">
                <label for="userType">I am a:</label>
                <select id="userType" name="userType" class="form-control">
                    <option value="landlord">Landlord</option>
                    <option value="warden">Warden</option>
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
