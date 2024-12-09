<?php
$dsn = "mysql:host=localhost;dbname=contact_electric";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
}

$query = "SELECT * FROM contact";
$contacts =$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
$services = $db->query("SELECT service_id, service_type FROM service")->fetchAll(PDO::FETCH_ASSOC);
$brands = $db->query("SELECT brand_id, brand_name FROM brand")->fetchAll(PDO::FETCH_ASSOC);
$products = $db->query("SELECT product_id, product_name FROM product")->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Contacts</h1>
        <ul class="list-unstyled">
            <?php foreach ($contacts as $contact): ?>
                <div class="card w-75 mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($contact['contact_first_name'] . ' ' . $contact['contact_last_name']); ?></h5>
                        <p class="card-text">
                            <strong>Phone:</strong> <?= htmlspecialchars($contact['contact_phone']); ?><br>
                            <strong>Addres:</strong> <?= htmlspecialchars($contact['contact_street']); ?><br>
                            <strong>ZIP:</strong> <?= htmlspecialchars($contact['contact_zip']); ?><br>
                            <strong>City:</strong> <?= htmlspecialchars($contact['contact_city']); ?><br>
                            <strong>State:</strong> <?= htmlspecialchars($contact['contact_state']); ?><br>
                            <strong>Site ZIP:</strong> <?= htmlspecialchars($contact['contact_site_zip']); ?><br>
                            <strong>Contacted Date(yyyy-mm-dd):</strong> <?= htmlspecialchars($contact['contact_contacted_date'] ?? 'Not yet contacted'); ?><br>
                            <strong>Service type:</strong> <?= htmlspecialchars($contact['service_id'])?><br>
                            
                        </p>
                        <a href="full_contact.php?contact_id=<?= urlencode($contact['contact_id']); ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
