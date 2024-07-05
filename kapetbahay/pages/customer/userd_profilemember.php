<?php
session_start();

include "config.php";

$successMessage = '';
$errorMessage = '';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE Username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $firstName = $row['Firstname'];
            $lastName = $row['Lastname'];
            $gender = $row['Gender'];
            $age = $row['Age'];
            $email = $row['Email'];
        } else {
            $errorMessage = "No user found for username: $username";
        }
    } else {
        $errorMessage = "Error fetching user details: " . mysqli_error($con);
    }
} else {
    header("Location: /kapetbahay/customer/login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-profile'])) {
    $newFirstName = mysqli_real_escape_string($con, $_POST['first-name']);
    $newLastName = mysqli_real_escape_string($con, $_POST['last-name']);
    $newGender = mysqli_real_escape_string($con, $_POST['gender']);
    $newAge = mysqli_real_escape_string($con, $_POST['age']);
    $newEmail = mysqli_real_escape_string($con, $_POST['email']);
    $username = $_SESSION['username'];

    $query = "UPDATE users SET Firstname='$newFirstName', Lastname='$newLastName', Gender='$newGender', Age='$newAge', Email='$newEmail' WHERE Username='$username'";

    if (mysqli_query($con, $query)) {
        $successMessage = 'Profile updated successfully!';
        $_SESSION['firstname'] = $newFirstName;
        $_SESSION['lastname'] = $newLastName;
        $_SESSION['gender'] = $newGender;
        $_SESSION['age'] = $newAge;
        $_SESSION['email'] = $newEmail;

        $firstName = $newFirstName;
        $lastName = $newLastName;
        $gender = $newGender;
        $age = $newAge;
        $email = $newEmail;
    } else {
        $errorMessage = "Error updating profile: " . mysqli_error($con);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-account'])) {
    $enteredPassword = mysqli_real_escape_string($con, $_POST['delete-password']);

    $query = "SELECT * FROM users WHERE Username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['Pass'];

            if (password_verify($enteredPassword, $hashedPassword)) {
                $deleteReservationsQuery = "DELETE FROM reservations WHERE Username = '$username'";
                if (mysqli_query($con, $deleteReservationsQuery)) {
                    $deleteUserQuery = "DELETE FROM users WHERE Username = '$username'";
                    if (mysqli_query($con, $deleteUserQuery)) {
                        session_destroy();
                        header("Location: /kapetbahay/customer/login");
                        exit();
                    } else {
                        $errorMessage = "Error deleting user account: " . mysqli_error($con);
                    }
                } else {
                    $errorMessage = "Error deleting reservations: " . mysqli_error($con);
                }
            } else {
                $errorMessage = "Incorrect password. Account Delete Failed.";
            }
        } else {
            $errorMessage = "No user found for username: $username";
        }
    } else {
        $errorMessage = "Error fetching user details: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Kape't Bahay Coffee Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/userdashboard.css"/>
    <style>
        .modal-centered {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
    </style>
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
                <div class="update-form">
                    <?php if (!empty($successMessage)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errorMessage)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>

                    <h2 class="text-center">Update Your Profile</h2>
                    <form method="post" action="/kapetbahay/customer/profile">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first-name">First Name</label>
                                <input type="text" class="form-control" id="first-name" name="first-name" value="<?php echo isset($firstName) ? htmlspecialchars($firstName) : ''; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last-name">Last Name</label>
                                <input type="text" class="form-control" id="last-name" name="last-name" value="<?php echo isset($lastName) ? htmlspecialchars($lastName) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="Male" <?php echo (isset($gender) && $gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo (isset($gender) && $gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                                    <option value="Others" <?php echo (isset($gender) && $gender == 'Others') ? 'selected' : ''; ?>>Others</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" value="<?php echo isset($age) ? htmlspecialchars($age) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required disabled>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block" name="update-profile">Submit</button>
                    </form>
                    <a href="#" class="delete-account">Delete Your Account?</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/kapetbahay/customer/profile">
                    <div class="modal-body">
                        <p>Are you sure you want to delete your account?</p>
                        <div class="form-group">
                            <label for="delete-password">Enter Your Password to Confirm</label>
                            <input type="password" class="form-control" id="delete-password" name="delete-password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="delete-account">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.delete-account').click(function () {
                $('#deleteAccountModal').modal('show');
            });
        });
    </script>
</body>
</html>
