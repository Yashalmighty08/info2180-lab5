<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$country = isset($_GET['country']) ? trim($_GET['country']) : '';
$like = '%' . $country . '%';

$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->bindParam(':country', $like);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
