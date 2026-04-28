<?php
include 'db.php';

// إضافة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_flight'])) {
    $stmt = $conn->prepare("INSERT INTO Flights 
    (FlightNumber, DepartureCity, ArrivalCity, DepartureDateTime, ArrivalDateTime, AvailableSeats) 
    VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssi",
        $_POST['number'],
        $_POST['departure'],
        $_POST['arrival'],
        $_POST['dep_time'],
        $_POST['arr_time'],
        $_POST['seats']
    );

    $stmt->execute();
    $stmt->close();
}

// حذف
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM Flights WHERE FlightID=?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    $stmt->close();
}

// عرض
$result = $conn->query("SELECT * FROM Flights");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
<h1>Flights</h1>

<form method="POST">
<input name="number" placeholder="Flight Number" required>
<input name="departure" placeholder="From" required>
<input name="arrival" placeholder="To" required>
<input type="datetime-local" name="dep_time" required>
<input type="datetime-local" name="arr_time" required>
<input type="number" name="seats" placeholder="Seats" required>
<button name="add_flight">Add</button>
</form>

<table>
<tr>
<th>ID</th><th>Number</th><th>From</th><th>To</th><th>Seats</th><th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['FlightID'] ?></td>
<td><?= $row['FlightNumber'] ?></td>
<td><?= $row['DepartureCity'] ?></td>
<td><?= $row['ArrivalCity'] ?></td>
<td><?= $row['AvailableSeats'] ?></td>
<td><a href="?delete=<?= $row['FlightID'] ?>">Delete</a></td>
</tr>
<?php endwhile; ?>

</table>
</div>
</body>
</html>