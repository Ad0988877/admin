<?php
session_start();

if (!isset($_SESSION['employee_id']) || $_SESSION['employee_id'] != 1) {
    header("Location: dash.php");
    exit;
}

$dsn = "mysql:host=localhost;dbname=contact_electric";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $hashed_password = password_hash($employee_password, PASSWORD_BCRYPT);

    $query = "INSERT INTO employee (employee_username, employee_password) VALUES (:employee_username, :hashed_password)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':employee_username' => $employee_username,
        ':hashed_password' => $hashed_password
    ]);

    echo "Employee added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
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
    <h1 class="mb-4">Add Employee</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-success">Add Employee</button>
        <a href="dash.php" class="btn btn-primary">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
