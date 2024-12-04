<?php
$dsn = "mysql:host=localhost;dbname=contacts";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo("connected");
} catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
}

$query = "SELECT * FROM contact";
$contacts =$db->query($query)->fetchAll(PDO::FETCH_ASSOC);

if (empty($contacts)) {
    echo "No employees found in the database.";
    exit;
}


$contact = null;
$contact_id = null;

if (isset($_GET['contact_id'])) {
    $contact_id = $_GET['contact_id'];
    $query = "SELECT * FROM contact WHERE contact_id = :contact_id";
    $stmt = $db->prepare($query);
    $stmt->execute([':contact_id' => $contact_id]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Info</title>
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
                            <strong>Id:</strong> <?= htmlspecialchars($contact['contact_id']); ?><br>
                            <strong>Phone:</strong> <?= htmlspecialchars($contact['contact_phone']); ?><br>
                            <strong>Address:</strong> <?= htmlspecialchars($contact['contact_address']); ?><br>
                            <strong>Street:</strong> <?= htmlspecialchars($contact['contact_street']); ?><br>
                            <strong>ZIP:</strong> <?= htmlspecialchars($contact['contact_zip']); ?><br>
                            <strong>City:</strong> <?= htmlspecialchars($contact['contact_city']); ?><br>
                            <strong>State:</strong> <?= htmlspecialchars($contact['contact_state']); ?><br>
                            <strong>Site Address:</strong> <?= htmlspecialchars($contact['contact_site_address']); ?><br>
                            <strong>Site Street:</strong> <?= htmlspecialchars($contact['contact_site_street']); ?><br>
                            <strong>Site ZIP:</strong> <?= htmlspecialchars($contact['contact_site_zip']); ?><br>
                            <strong>Site City:</strong> <?= htmlspecialchars($contact['contact_site_city']); ?><br>
                            <strong>Site State:</strong> <?= htmlspecialchars($contact['contact_site_state']); ?><br>
                            <strong>Submit Date:</strong> <?= htmlspecialchars($contact['contact_submit_date']); ?><br>
                            <strong>Contacted Date:</strong> <?= htmlspecialchars($contact['contact_contacted_date'] ?? 'Not yet contacted'); ?><br>
                            <strong>Service ID:</strong> <?= htmlspecialchars($contact['service_id']); ?><br>
                            <strong>Brand ID:</strong> <?= htmlspecialchars($contact['brand_id']); ?><br>
                            <strong>Product ID:</strong> <?= htmlspecialchars($contact['product_id']); ?><br>
                        </p>
                        <a href="dash.php" class="btn btn-primary">Return</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>