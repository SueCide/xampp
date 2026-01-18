<?php
$conn = new mysqli("localhost", "root", "", "fejsbuk");

$result = $conn->query("SELECT username FROM users");

$users = [];
while ($row = $result->fetch_assoc()) {
  $users[] = $row;
}

echo json_encode($users);
