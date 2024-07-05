n<?php
session_start();

include "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: /kapetbahay/customer/login");
    exit();
}

$username = $_SESSION['username'];

$reservations = array();
$query = "SELECT * FROM reservations WHERE Username = '$username'";
$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }
} else {
    echo "Error fetching reservations: " . mysqli_error($con);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_reservation_id'])) {
    $cancel_id = mysqli_real_escape_string($con, $_POST['cancel_reservation_id']);
    $update_query = "UPDATE reservations SET Status = 'Cancelled' WHERE ReservationID = '$cancel_id' AND Username = '$username'";
    if (mysqli_query($con, $update_query)) {
        $_SESSION['reservation_message'] = "Reservation successfully cancelled!";
    } else {
        $_SESSION['reservation_message'] = "Error: " . $update_query . "<br>" . mysqli_error($con);
    }

    $reservations = array();
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reservations[] = $row;
        }
    } else {
        echo "Error fetching reservations: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservation - Kape't Bahay Coffee Shop</title>
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
                    <a class="nav-link btn" href="/kapetbahay/customer/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid d-flex flex-column">
        <div class="row flex-fill">
            <div class="col-md-3 sidebar">
                <?php if (isset($_SESSION['username'])) {
                    echo "<h4 id='member-name'>" . htmlspecialchars($username) . "</h4>";
                    echo "<p>Member</p>";
                } ?>
                
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
                <div class="reservation-list bg-light p-4 rounded">
                    <h2 class="text-center">My Reservations</h2>
                    <?php if (isset($_SESSION['reservation_message'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['reservation_message']; unset($_SESSION['reservation_message']); ?>
                        </div>
                    <?php } ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Reservation #</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Person #</th>
                                <th scope="col">Note</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($reservations)) {
                                foreach ($reservations as $reservation) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($reservation['ReservationID']) . "</td>";
                                    echo "<td>" . htmlspecialchars($reservation['ReservedDate']) . "</td>";
                                    echo "<td>" . htmlspecialchars($reservation['ReservedTime']) . "</td>";
                                    echo "<td>" . htmlspecialchars($reservation['TableNum']) . "</td>";
                                    echo "<td>" . htmlspecialchars($reservation['Note']) . "</td>";
                                    echo "<td>" . htmlspecialchars($reservation['Status']) . "</td>";
                                    echo "<td>
                                            <form method='POST' action='' class='d-inline'>
                                                <input type='hidden' name='cancel_reservation_id' value='" . htmlspecialchars($reservation['ReservationID']) . "'>";
                                    if ($reservation['Status'] == 'Pending') {
                                        echo "<button type='submit' class='btn btn-outline-secondary btn-sm'>Cancel</button>";
                                    } else {
                                        echo "<button type='button' class='btn btn-outline-secondary btn-sm' disabled>Cancelled</button>";
                                    }
                                    echo "</form>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No reservations found.</td></tr>";
                            }
                            ?>
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
