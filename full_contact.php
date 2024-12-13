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

if (isset($_GET['contact_id'])) {
    $contact_id = filter_input(INPUT_GET, 'contact_id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM contact WHERE contact_id = :contact_id";
    $stmt = $db->prepare($query);
    $stmt->execute([':contact_id' => $contact_id]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contacted_date = null;
    if (isset($_POST['update_contacted_date']) && $_POST['update_contacted_date'] === 'on') {
        $contacted_date = date('Y-m-d H:i:s');
    }

    if ($contacted_date) {
        $query = "UPDATE contact SET contact_contacted_date = :contacted_date WHERE contact_id = :contact_id";
        $stmt = $db->prepare($query);
        $stmt->execute([':contacted_date' => $contacted_date, ':contact_id' => $contact_id]);
    }
}

$query = "SELECT * FROM contact";
$contacts = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dash.php">Home</a>
                </li>
                <?php if (isset($_SESSION['employee_id']) && $_SESSION['employee_id'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add_employee.php">Add Employee</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container mt-5">
    <div class="card w-75 mb-3">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($contact['contact_first_name'] . ' ' . $contact['contact_last_name']); ?></h5>
            <p class="card-text">
                <strong>Id:</strong> <?= htmlspecialchars($contact['contact_id']); ?><br>
                <strong>Phone:</strong> <?= htmlspecialchars($contact['contact_phone']); ?><br>
                <strong>Address:</strong> <?= htmlspecialchars($contact['contact_street']); ?><br>
                <strong>ZIP:</strong> <?= htmlspecialchars($contact['contact_zip']); ?><br>
                <strong>City:</strong> <?= htmlspecialchars($contact['contact_city']); ?><br>
                <strong>State:</strong> <?= htmlspecialchars($contact['contact_state']); ?><br>
                <strong>Site Address:</strong> <?= htmlspecialchars($contact['contact_site_street']); ?><br>
                <strong>Site ZIP:</strong> <?= htmlspecialchars($contact['contact_site_zip']); ?><br>
                <strong>Site City:</strong> <?= htmlspecialchars($contact['contact_site_city']); ?><br>
                <strong>Site State:</strong> <?= htmlspecialchars($contact['contact_site_state']); ?><br>
                <strong>Submit Date:</strong> <?= htmlspecialchars($contact['contact_submit_date']); ?><br>
                <strong>Contacted Date:</strong> <?= htmlspecialchars($contact['contact_contacted_date'] ?? 'Not yet contacted'); ?><br>
                <strong>Service ID:</strong> <?= htmlspecialchars($contact['service_id']); ?><br>
                <strong>Brand ID:</strong> <?= htmlspecialchars($contact['brand_id']); ?><br>
                <strong>Product ID:</strong> <?= htmlspecialchars($contact['product_id']); ?><br>
            </p>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="update_contacted_date">Update Contacted Date</label>
                    <input type="checkbox" name="update_contacted_date" id="update_contacted_date">
                    <small class="form-text text-muted">Check to record the current date as the contacted date.</small>
                </div>
                <button type="submit" class="btn btn-success">Update Contacted Date</button>
            </form>

            <a href="dash.php" class="btn btn-primary">Return</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>