<?php
include 'db.php';

$results = [];

if (isset($_GET['search'])) {
    $term = "%" . $_GET['term'] . "%";

    $stmt = $conn->prepare("
        SELECT p.FullName, f.FlightNumber, f.DepartureCity, f.ArrivalCity
        FROM Bookings b
        JOIN Passengers p ON b.PassengerID = p.PassengerID
        JOIN Flights f ON b.FlightID = f.FlightID
        WHERE p.FullName LIKE ?
    ");

    $stmt->bind_param("s", $term);
    $stmt->execute();
    $results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h1>Search</h1>

    <form>
        <input type="text" name="term" placeholder="Search passenger name">
        <button name="search">Search</button>
    </form>

    <table>
        <tr>
            <th>Name</th>
            <th>Flight</th>
            <th>From</th>
            <th>To</th>
        </tr>

        <?php if (!empty($results)): ?>
            <?php while($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['FullName'] ?></td>
                    <td><?= $row['FlightNumber'] ?></td>
                    <td><?= $row['DepartureCity'] ?></td>
                    <td><?= $row['ArrivalCity'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </table>
</div>

</body>
</html>