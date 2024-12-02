<?php
$dsn = "mysql:host=localhost;dbname=ozarktechwebdev_all_electric";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo("connected");
} catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
}

$query = "SELECT * FROM contacts";
$contacts =$db->query($query)->fetchAll(PDO::FETCH_ASSOC);

if (empty($contacts)) {
    echo "No employees found in the database.";
    exit;
}
?>

<ul class="list">
    <?php foreach ($contacts as $contact): ?>
    <div class="card w-75">
        <div class="card-body">
        <p class="card-text">
            <!-- input data here -->
        </p>
        <a href="#" class="btn btn-primary">Button</a>
    </div>
    <?php endforeach; ?>
</ul>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>




</div>



</body>
</html>