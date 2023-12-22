<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0; /* Set your desired background color */
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .error-container {
            padding: 20px;
            background-color: #ffffff; /* Set your desired background color */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="error-container">

    <?php
if (empty($_POST["name"])) {
    die("Name is required");
}

if (empty($_POST["email"])) {
    die("Email is required");
}

if (empty($_POST["student_id"])) {
    die("Student ID is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$mysqli = require __DIR__ . "/database.php";

// Check if the email already exists
$emailCheckSql = "SELECT COUNT(*) FROM user WHERE email = ?";
$emailCheckStmt = $mysqli->prepare($emailCheckSql);
$emailCheckStmt->bind_param("s", $_POST["email"]);
$emailCheckStmt->execute();
$emailCheckStmt->bind_result($emailCount);
$emailCheckStmt->fetch();
$emailCheckStmt->close();

if ($emailCount > 0) {
    die("Email already exists. Please use a different email address.");
}

// Insert new user
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$insertSql = "INSERT INTO user (name, email, password_hash, id) VALUES (?, ?, ?, ?)";
$insertStmt = $mysqli->prepare($insertSql);

if (!$insertStmt) {
    die("SQL error: " . $mysqli->error);
}

$insertStmt->bind_param("ssss", $_POST["name"], $_POST["email"], $password_hash, $_POST["student_id"]);

if ($insertStmt->execute()) {
    // Registration successful, redirect to login form
    header("Location: login.php"); // Replace with the actual path to your login form
    exit;
} else {
    die("Error: " . $insertStmt->error);
}
?>
 </div>
</body>

</html>
