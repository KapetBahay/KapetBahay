<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    include "config.php";

    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $firstname = mysqli_real_escape_string($con, $_POST['Firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['Lastname']);
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $contact_number = isset($_POST['ContactNum']) ? $_POST['ContactNum'] : '';
    $gender = mysqli_real_escape_string($con, $_POST['Gender']);
    $age = mysqli_real_escape_string($con, $_POST['Age']);
    $password = mysqli_real_escape_string($con, $_POST['Pass']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $user_check_query = "SELECT * FROM users WHERE Email='$email' OR Username='$username' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    $error_message = '';
    $success_message = '';

    if ($user) {
        if ($user['Email'] === $email) {
            $error_message = "Email already exists. Please use a different email.";
        }
        if ($user['Username'] === $username) {
            $error_message = "Username already exists. Please choose a different username.";
        }
    } else {
        if ($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (Email, Firstname, Lastname, Username, ContactNum, Gender, Age, Pass) 
                      VALUES ('$email', '$firstname', '$lastname', '$username', '$contact_number', '$gender', '$age', '$hashed_password')";

            if (mysqli_query($con, $query)) {
                $success_message = "You have successfully created your account!";
            } else {
                $error_message = "Error: " . $query . "<br>" . mysqli_error($con);
            }
        }
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kape't Bahay Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php 
      echo '<link rel="stylesheet" href="../assets/css/register.css"/>';
    ?>
</head>
<body>
    <div class="container-fluid main-container d-flex align-items-center justify-content-center">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="registration-container">
                <form method="POST">
                    <h2 class="text-center">Register as a Member</h2>
                    <?php
                    if (!empty($error_message)) {
                        echo "<p class='text-danger'>$error_message</p>";
                    }
                    if (!empty($success_message)) {
                        echo "<p class='text-success'>$success_message</p>";
                    }
                    ?>
                    <div class="row">
                        <div class="col">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="Firstname" aria-label="First name" required>
                        </div>
                        <div class="col">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" name="Lastname" aria-label="Last name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="Age" required>
                        </div>
                        <div class="col">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="Gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" class="form-control" id="contact-number" name="ContactNum" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="Pass" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-dark btn-block">Submit</button>
                    <p><a href="/kapetbahay/customer/login">Already have an Account?</a></p>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
