<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/login.css">
        <style>
        body {
            background-color: #f4f4f5; 
        }
        .registration-form {
            background-color: #ffffff; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            margin-top: 40px; 
        }
        .form-title {
            color: #6a1b9a; 
            margin-bottom: 20px; 
        }
        .btn-custom-purple {
            background-color: #6a1b9a; 
            color: #ffffff; 
            border: none; 
        }
        .btn-custom-purple:hover {
            background-color: #5e35b1; 
        }
    </style>
</head>
<body>
<?php include 'nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
          
            <div class="registration-form">
                <h2 class="form-title text-center">Landlord Registration</h2>
                <form action="register_landlord_process.php" method="post">
                    <div class="form-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email Address:</label>
                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                  
                    <button type="submit" class="btn btn-custom-purple btn-block">Register</button>
                </form>
            </div>
           
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
