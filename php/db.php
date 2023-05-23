<?php
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=';
$user = 'root';
$pass = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];
try {
    $connexion = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!-- 
$connexion = $GLOBALS['connexion'];
$query = '';
$stmt = $connexion->prepare($query);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
-->