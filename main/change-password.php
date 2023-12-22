<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and update the password in the database
    $mysqli = require __DIR__ . "/database.php";

    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate new password
    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $mysqli->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        $stmt->execute();

        // Redirect to a success page or login page
        header("Location: password-changed.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Change Password</h1>

    <?php if (isset($error_message)): ?>
        <em><?= $error_message ?></em>
    <?php endif; ?>

    <form method="post">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <input type="submit" value="Change Password">

        <br>

        <p><a href="login.php">Back to Login</a></p><?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and update the password in the database
    $mysqli = require __DIR__ . "/database.php";

    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate new password
    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $mysqli->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        $stmt->execute();

        // Redirect to a success page or login page
        header("Location: password-changed.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Change Password</h1>

    <?php if (isset($error_message)): ?>
        <em><?= $error_message ?></em>
    <?php endif; ?>

    <form method="post">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <input type="submit" value="Change Password">

        <br>

        <p><a href="login.php">Back to Login</a></p>
    </form>

</body>
</html>

 
