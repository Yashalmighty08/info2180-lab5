<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$country = isset($_GET['country']) ? trim($_GET['country']) : '';
$like = '%' . $country . '%';

$stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state
FROM countries WHERE name LIKE :country
ORDER BY name"
);
$stmt->bindParam(':country', $like);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if (count($results) === 0): ?>
<p>No results found.</p>
<?php else: ?>
  <table>
    <thead>
      <tr><th>Name</th><th>Continent</th><th>Independence</th><th>Head of State</th></tr>
    </thead>
    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?= htmlentities($row['name']); ?></td>
          <td><?= htmlentities($row['continent']); ?></td>
          <td><?=  htmlentities((string) $row['independence_year']) ?></td>
          <td><?= htmlentities((string) $row['head_of_state']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>
  