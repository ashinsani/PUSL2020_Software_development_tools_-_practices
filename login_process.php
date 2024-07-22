<?php
session_start();


$conn = new mysqli('localhost', 'root', '', 'nsbm_property');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userType = $_POST['userType'];
    $username = $_POST['email'];
    $password = $_POST['password'];

   
    $tableMap = [
        'landlord' => 'landlord',
        'warden' => 'warden',
        'student' => 'student',
        'admin' => 'admin',
    ];

    if (!array_key_exists($userType, $tableMap)) {
        die("Invalid user type."); 
    }

    $tableName = $tableMap[$userType];


    $sql = "SELECT password FROM `$tableName` WHERE emailAddress = ? LIMIT 1";


    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error); 
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo ucfirst($userType) . " login successful.";
         
            if($userType == "student"){
                $_SESSION['user_type'] = "student";
                $_SESSION['user_id'] = $username;

       
                header("Location: all_advertisement.php");
            }
            elseif($userType == "warden"){
                $_SESSION['user_type'] = "warden";

              
                header("Location: view.php");
            }
            elseif($userType == "landlord"){
                $_SESSION['user_type'] = "landlord";
                
                $_SESSION['landlord_email'] = $username;

                header("Location: add.php");
            }
            elseif($userType == "admin"){
                $_SESSION['user_type'] = "admin";

              
                header("Location: create_account.php");
            }
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "Username does not exist.";
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();

?>