<?php
session_set_cookie_params([
    "path" => "/"
]);
session_start();

if (empty($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$conn = new mysqli("localhost", "root", "", "fejsbuk");

$stmt = $conn->prepare("SELECT 1 FROM users WHERE username = ?");
$stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    session_destroy();
    header("Location: login.html");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
    <link rel="stylesheet" href="fejs.css">
    <script type="module" src="fejs.js" defer></script>
    <link rel="icon" href="../src/favicon.ico" type="image/x-icon">
</head>
<body>
    
    <h1>u are in</h1>
    <button id="logout" type="button">logout</button>

</body>
</html>