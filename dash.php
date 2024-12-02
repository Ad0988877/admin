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
        <li class="data">
            <h3><?php echo $contact['contact_id']; ?></h3>
            <p>first name: <?php echo $contact['contact_first_name']; ?></p>
            <p>last name: <?php echo $contact['contact_last_name']; ?></p>
            <p>phone number: <?php echo $contact['contact_phone']; ?></p>
            <p>address: <?php echo $contact['contact_adrress']; ?></p>
            <p>service id: <?php echo $contact['service_id']; ?></p>
        </li>
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
    
</body>
</html>