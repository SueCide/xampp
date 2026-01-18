<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

header("Content-Type: application/json");

$raw = file_get_contents("php://input");

$data = json_decode($raw,true);

$username_in = $data["username"]??null;
$password_inn = $data["password"]??null;
$password_in = trim($password_inn);


try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=fejsbuk;charset=utf8mb4",
        "root",
        ""
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed"
    ]);
    exit;
}

$stmt = $pdo->prepare(
    "SELECT password FROM users WHERE username = :username"
);
$stmt->execute([
    ":username" => $username_in
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);





if (!$user) {
    echo json_encode([
        "status" => "error",
        "message" => "User does not exist"
    ]);
    exit;
}


if (password_verify($password_in, $user["password"])) {

    session_set_cookie_params([
        "path" => "/"
    ]);
    session_start();

    $_SESSION["user_id"]=$username_in;


    echo json_encode([
        "status" => "success",
        "message" => "Login successful"
    ]);
} else {
    

    echo json_encode([
        "status" => "error",
        "message" => "Wrong password"
        
    ]);
    
}
exit;