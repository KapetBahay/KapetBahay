<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        include "config.php";

        $username = mysqli_real_escape_string($con, $_POST['Username']);
        $password = mysqli_real_escape_string($con, $_POST['Pass']);

        if ($username != "" && $password != "") {
            $query = "SELECT Username, Email, Pass FROM users WHERE Username = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $db_username, $db_email, $stored_password);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_fetch($stmt);
                    if (password_verify($password, $stored_password)) {
                        $_SESSION['username'] = $db_username;
                        $_SESSION['email'] = $db_email;
                        header("Location: /kapetbahay/customer/profile");
                        exit();
                    } else {
                        $error_message = "Invalid Username or Password!";
                    }
                } else {
                    $error_message = "Invalid Username or Password!";
                }

                mysqli_stmt_close($stmt);
            } else {
                $error_message = "Error: " . mysqli_error($con);
            }
        } else {
            $error_message = "Username and Password are required!";
        }

        mysqli_close($con);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kape't Bahay Coffee Shop</title>
    <?php
        echo'<link rel="stylesheet" href="../assets/css/login.css"/>';
    ?>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form method="post">
                <h2>Login to your account</h2>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="Username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="Pass" required>
                </div>
                <button type="submit" name="login">Login</button>
                <p><a href="/kapetbahay/customer/register">Don't have an account?</a></p>
                <p><a href="/kapetbahay/admin/login">Are you an Admin?</a></p>
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
