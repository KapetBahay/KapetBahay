<?php
session_start();
include_once 'config.php';

$admin_name = isset($_SESSION['username']) ? $_SESSION['username'] : null;
if (!$admin_name) {
    header("Location: /kapetbahay/admin/login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve_reservation'])) {
        $reservation_id = isset($_POST['reservation_id']) ? mysqli_real_escape_string($con, $_POST['reservation_id']) : null;
        if (!empty($reservation_id)) {
            $status = "Approved";
            $update_query = "UPDATE reservations SET Status = '$status' WHERE ReservationID = $reservation_id";
            if (mysqli_query($con, $update_query)) {
                header("Location: /kapetbahay/admin/reservation-list");
                exit();
            } else {
                echo "Error updating reservation status.";
            }
        } else {
            echo "Invalid reservation ID.";
        }
    } elseif (isset($_POST['deny_reservation'])) {
        $reservation_id = isset($_POST['reservation_id']) ? mysqli_real_escape_string($con, $_POST['reservation_id']) : null;
        if (!empty($reservation_id)) {
            $status = "Denied";
            $update_query = "UPDATE reservations SET Status = '$status' WHERE ReservationID = $reservation_id";
            if (mysqli_query($con, $update_query)) {
                header("Location: /kapetbahay/admin/reservation-list");
                exit();
            } else {
                echo "Error updating reservation status.";
            }
        } else {
            echo "Invalid reservation ID.";
        }
    }
}

$query = "SELECT * FROM reservations WHERE Status != 'Cancelled'";
$result = mysqli_query($con, $query);

$reservations = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation List - Kape't Bahay Coffee Shop</title>
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
            <div class="col-md-3 sidebar ">
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
                    <h2 class="text-center">Customer Reservations</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Reservation #</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Table #</th>
                                <th scope="col">Note</th>
                                <th scope="col">Request Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation) : ?>
                                <tr>
                                    <td><?php echo $reservation['ReservationID']; ?></td>
                                    <td><?php echo $reservation['Username']; ?></td>
                                    <td><?php echo $reservation['ReservedDate']; ?></td>
                                    <td><?php echo $reservation['ReservedTime']; ?></td>
                                    <td><?php echo $reservation['TableNum']; ?></td>
                                    <td><?php echo $reservation['Note']; ?></td>
                                    <td><?php echo $reservation['RequestDate']; ?></td>
                                    <td><?php echo $reservation['Status']; ?></td>
                                    <td>
                                        <form action="/kapetbahay/admin/reservation-list" method="post">
                                            <input type="hidden" name="reservation_id" value="<?php echo $reservation['ReservationID']; ?>">
                                            <button type="submit" name="approve_reservation" class="btn btn-success btn-sm">Approve</button>
                                            <button type="submit" name="deny_reservation" class="btn btn-danger btn-sm">Deny</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
