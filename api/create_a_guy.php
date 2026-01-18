<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

header("Content-Type: application/json");

$raw = file_get_contents("php://input");

$data = json_decode($raw,true);

$username = $data["username"]??null;
$password = $data["password"]??null;

if (!$username || !$password) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing username or password"
    ]);
    exit;
}

$hashedPassword = password_hash(trim($password),PASSWORD_DEFAULT);

try {

    $pdo = new PDO(

        "mysql:host=localhost;dbname=fejsbuk;charset=utf8mb4",
        "root",
        "" 

    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOExeption $e) {

    echo json_encode([

        "status" => "error",
        "message" => "Database connection failed"

    ]);
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO users (username, password) VALUES (:username, :password)"
    );

    $stmt->execute([
        ":username" => $username,
        ":password" => $hashedPassword
    ]);

    echo json_encode([
        "status" => "success",
        "message" => "User created"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Username already exists"
    ]);
}