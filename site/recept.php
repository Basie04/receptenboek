<?php
require 'database.php';
$stmt = $conn->prepare("SELECT * FROM recept");
$stmt->execute();

$all_recepten = $stmt->fetch(PDO::FETCH_ASSOC);


print_r($all_recepten);
?>