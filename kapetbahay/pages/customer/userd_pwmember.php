<?php
session_start();

include "config.php";

$message = "";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE Username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];
            $hashedPassword = $row['Pass'];
        } else {
            $message = "No user found for username: $username";
        }
    } else {
        $message = "Error fetching user details: " . mysqli_error($con);
    }
} else {
    header("Location: /kapetbahay/customer/login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = mysqli_real_escape_string($con, $_POST['old-password']);
    $newPassword = mysqli_real_escape_string($con, $_POST['new-password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm-password']);

    if (password_verify($oldPassword, $hashedPassword)) {
        if ($newPassword === $confirmPassword) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE users SET Pass='$hashedNewPassword' WHERE id='$userId'";

            if (mysqli_query($con, $updateQuery)) {
                $message = '<div class="alert alert-success" role="alert">Password updated successfully!</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Error updating password: ' . mysqli_error($con) . '</div>';
            }
        } else {
            $message = '<div class="alert alert-danger" role="alert">New password and confirmation password do not match.</div>';
        }
    } else {
        $message = '<div class="alert alert-danger" role="alert">Incorrect old password.</div>';
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Kape't Bahay Coffee Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/userdashboard.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/kapetbahay/">
            <img src="../assets/Images/logo3.png" alt="Kape't Bahay Coffee Shop Logo" width="300" height="50" class="d-inline-block align-top">
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn" href="/kapetbahay/customer/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid d-flex flex-column">
        <div class="row">
            <div class="col-md-3 sidebar">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo "<h4 id='member-name'>$username</h4>";
                    echo "<p>Member</p>";
                }
                ?>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/kapetbahay/customer/profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kapetbahay/customer/change-password">Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kapetbahay/customer/reservation">Make a Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kapetbahay/customer/my-reservation">My Reservations</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 main-content">
                <?php
                if (!empty($message)) {
                    echo $message;
                }
                ?>
                <div class="update-form">
                    <h2 class="text-center">Update Your Password</h2>
                    <form method="post" action="/kapetbahay/customer/change-password">
                        <div class="form-group">
                            <label for="old-password">Old Password</label>
                            <input type="password" class="form-control" id="old-password" name="old-password" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new-password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>