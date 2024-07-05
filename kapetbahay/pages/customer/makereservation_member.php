<?php
session_start();

include "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: /kapetbahay/customer/login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_SESSION['username'];
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $tableNum = mysqli_real_escape_string($con, $_POST['table']);
    $note = mysqli_real_escape_string($con, $_POST['note']);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $check_query = "SELECT * FROM reservations WHERE TableNum = '$tableNum' AND Status = 'Pending'";
    $check_result = mysqli_query($con, $check_query);

    if ($check_result) {
        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['reservation_message'] = "Error: Table number $tableNum is already reserved and pending approval.";
        } else {
            $query = "INSERT INTO reservations (Username, TableNum, ReservedDate, ReservedTime, RequestDate, Note, Status) 
                      VALUES ('$username', '$tableNum', '$date', '$time', CURDATE(), '$note', 'Pending')";

            if (mysqli_query($con, $query)) {
                $_SESSION['reservation_message'] = "Reservation successfully made!";
            } else {
                $_SESSION['reservation_message'] = "Error: " . $query . "<br>" . mysqli_error($con);
            }
        }
    } else {
        $_SESSION['reservation_message'] = "Error checking reservation: " . mysqli_error($con);
    }

    mysqli_close($con);
    header("Location: /kapetbahay/customer/reservation");
    exit();
}

$reservedTables = array();
$fetch_query = "SELECT TableNum FROM reservations WHERE Status = 'Pending'";
$fetch_result = mysqli_query($con, $fetch_query);

if ($fetch_result) {
    while ($row = mysqli_fetch_assoc($fetch_result)) {
        $reservedTables[] = $row['TableNum'];
    }
} else {
    echo "Error fetching reserved tables: " . mysqli_error($con);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation - Kape't Bahay Coffee Shop</title>
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn" href="/kapetbahay/customer/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
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
                    <h2 class="text-center">Make a Reservation</h2>
                    <?php
                    if (isset($_SESSION['reservation_message'])) {
                        $message_type = strpos($_SESSION['reservation_message'], 'successfully') !== false ? 'success' : 'danger';
                        echo '<div class="alert alert-' . $message_type . ' alert-dismissible fade show" role="alert">
                                ' . $_SESSION['reservation_message'] . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                        unset($_SESSION['reservation_message']);
                    }
                    ?>
                    <form method="POST" action="/kapetbahay/customer/reservation">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="table">Kubo for How Many?</label>
                            <select class="form-control" id="table" name="table" required>
                                <?php
                                for ($i = 1; $i <= 15; $i++) {
                                    if (!in_array($i, $reservedTables)) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea class="form-control" id="note" name="note" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block">Submit Reservation</button>
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
