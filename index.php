<?php
session_start();
include "bootstrap_connection.php";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        if (file_exists('user.csv')) {
            $users = array_map('str_getcsv', file('user.csv'));
        } else {
            die("Error: user.csv file not found.");
        }

        $valid = false;
        foreach ($users as $user) {
            if ($user[0] === $username && $user[1] === $password) {
                $valid = true;
                break;
            }
        }

        if ($valid) {
            header('Location: dash.php');
            exit();
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
