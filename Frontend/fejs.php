<?php
    session_set_cookie_params([
    "path" => "/"
    ]);
    session_start();
    
    $conn = new mysqli("localhost", "root", "", "fejsbuk");

    $result = $conn->query("SELECT username FROM users");

    $users = [] ;
    while ($row = $result->fetch_assoc()) {
    $users[] = $row;
    }
    $usernames = array_column($users,'username');

   if(!in_array($_SESSION["user_id"],$usernames)){
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
    <script src="fejs.js" defer></script>
    <link rel="icon" href="../src/favicon.ico" type="image/x-icon">
</head>
<body>
    
    <h1>u are in</h1>
    <button id="back_login_button" type="button">back to login</button>

</body>
</html>