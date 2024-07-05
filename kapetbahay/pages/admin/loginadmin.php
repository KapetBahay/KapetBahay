<?php
include_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $entered_password = mysqli_real_escape_string($con, $_POST['Pass']);

    if ($username != "" && $entered_password != "") {
        $query = "SELECT Pass FROM admin WHERE Username = ?";
        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $stored_password);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_fetch($stmt);
                if ($entered_password === $stored_password) {
                    $_SESSION['username'] = $username;
                    header("Location: /kapetbahay/admin/user-list");
                    exit;
                } else {
                    $error_message = "Invalid Username or Password!";
                }
            } else {
                $error_message = "Invalid Username or Password!";
            }

            mysqli_stmt_close($stmt);
        } else {
            $error_message = "Database query error!";
        }
    } else {
        $error_message = "Username and Password are required!";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form method="post" action="">
                <h2>Login to your account</h2>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="Username" name="Username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="Pass" name="Pass" required>
                </div>
                <button type="submit" name="login">Login</button>
                <p><a href="/kapetbahay/customer/login">Are you a Customer?</a></p>
            </form>

            <?php
            if (isset($error_message)) {
                echo "<p style='color: #ff0f0f !important;'>$error_message</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
