<?php
include 'db.php';

// إضافة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_passenger'])) {
    $stmt = $conn->prepare("INSERT INTO Passengers (FullName, PassportNumber, ContactNumber) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['name'], $_POST['passport'], $_POST['contact']);
    $stmt->execute();
    $stmt->close();
}

// حذف
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM Passengers WHERE PassengerID=?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    $stmt->close();
}

// عرض
$result = $conn->query("SELECT * FROM Passengers");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
<h1>Passengers</h1>

<form method="POST">
    <input name="name" placeholder="Name" required>
    <input name="passport" placeholder="Passport" required>
    <input name="contact" placeholder="Contact" required>
    <button name="add_passenger">Add</button>
</form>

<table>
<tr>
<th>ID</th><th>Name</th><th>Passport</th><th>Contact</th><th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['PassengerID'] ?></td>
<td><?= $row['FullName'] ?></td>
<td><?= $row['PassportNumber'] ?></td>
<td><?= $row['ContactNumber'] ?></td>
<td><a href="?delete=<?= $row['PassengerID'] ?>">Delete</a></td>
</tr>
<?php endwhile; ?>

</table>
</div>
</body>
</html>