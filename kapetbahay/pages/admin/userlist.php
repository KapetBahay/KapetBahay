<?php
session_start();
include_once 'config.php';

$admin_name = isset($_SESSION['username']) ? $_SESSION['username'] : null;
if (!$admin_name) {
    header("Location: /kapetbahay/admin/login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($con, $_POST['user_id']) : null;

    if (!empty($user_id)) {
        $query = "DELETE FROM users WHERE id = ?";
        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("Location: /kapetbahay/admin/user-list");
            exit();
        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "Invalid user ID.";
    }
}

$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

$users = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List - Kape't Bahay Coffee Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/myreservation.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/kapetbahay/">
            <img src="../assets/Images/logo3.png" alt="Kape't Bahay Coffee Shop Logo" width="300" height="50" class="d-inline-block align-top">
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn" href="/kapetbahay/admin/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid d-flex flex-column">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h4 id="admin-name"><?php echo $admin_name; ?></h4>
                <p>Admin</p>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/kapetbahay/admin/reservation-list">Reservation List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kapetbahay/admin/user-list">User List</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 main-content">
                <div class="reservation-list bg-light p-4 rounded">
                    <h2 class="text-center">User List</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">User ID#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Contact #</th>
                                <th scope="col">Email</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Age</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['Firstname'] . " " . $user['Lastname']; ?></td>
                                        <td><?php echo $user['Username']; ?></td>
                                        <td><?php echo $user['ContactNum']; ?></td>
                                        <td><?php echo $user['Email']; ?></td>
                                        <td><?php echo $user['Gender']; ?></td>
                                        <td><?php echo $user['Age']; ?></td>
                                        <td>
                                            <form method="post" action="/kapetbahay/admin/user-list">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" name="delete_user" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr><td colspan='8' class='text-center'>No users found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
