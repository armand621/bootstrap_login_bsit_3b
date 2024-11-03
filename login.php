<?php

session_start();

$users = [
    "Admin" => [
        ["username" => "admin", "password" => "Pass1234"],
        ["username" => "renmark", "password" => "Pogi1234"]
    ],
    "Content Manager" => [
        ["username" => "pepito", "password" => "manaloto"],
        ["username" => "juan", "password" => "delacruz"]
    ],
    "System User" => [
        ["username" => "pedro", "password" => "penduko"]
    ]
];


$message = '';
$type = 'alert-warning'; 


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userType = $_POST['userType'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($userType) || empty($username) || empty($password)) {
        $message = "Please fill in all fields.";
    } else {
        $validUser = false;

        
        if (isset($users[$userType])) {
            foreach ($users[$userType] as $user) {
                if ($user['username'] === $username && $user['password'] === $password) {
                    $validUser = true;
                    $message = "Welcome to the System: " . htmlspecialchars($username);
                    $type = 'alert-success'; 
                    break;
                }
            }
        }

        if (!$validUser) {
            $message = "Invalid username or password.";
            $type = 'alert-danger'; 
        }
    }

    
    $_SESSION['message'] = $message;
    $_SESSION['type'] = $type;

 
    header("Location: index.php");
    exit();
}
?>
