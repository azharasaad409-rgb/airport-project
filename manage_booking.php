<?php
include 'db.php';

// إضافة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_booking'])) {
    $stmt = $conn->prepare("INSERT INTO Bookings (PassengerID, FlightID, BookingDate) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $_POST['passenger_id'], $_POST['flight_id'], $_POST['booking_date']);
    $stmt->execute();
    $stmt->close();
}

// حذف
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM Bookings WHERE BookingID=?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    $stmt->close();
}

// عرض
$result = $conn->query("
SELECT b.BookingID, p.FullName, f.FlightNumber, b.BookingDate
FROM Bookings b
JOIN Passengers p ON b.PassengerID=p.PassengerID
JOIN Flights f ON b.FlightID=f.FlightID
");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
<h1>Bookings</h1>

<form method="POST">
<input name="passenger_id" placeholder="Passenger ID" required>
<input name="flight_id" placeholder="Flight ID" required>
<input type="datetime-local" name="booking_date" required>
<button name="add_booking">Add</button>
</form>

<table>
<tr>
<th>ID</th><th>Name</th><th>Flight</th><th>Date</th><th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['BookingID'] ?></td>
<td><?= $row['FullName'] ?></td>
<td><?= $row['FlightNumber'] ?></td>
<td><?= $row['BookingDate'] ?></td>
<td><a href="?delete=<?= $row['BookingID'] ?>">Delete</a></td>
</tr>
<?php endwhile; ?>

</table>
</div>
</body>
</html>