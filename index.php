<?php
include 'db.php';

$p = $conn->query("SELECT COUNT(*) c FROM Passengers")->fetch_assoc();
$f = $conn->query("SELECT COUNT(*) c FROM Flights")->fetch_assoc();
$b = $conn->query("SELECT COUNT(*) c FROM Bookings")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Dashboard</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

<h1 class="title">Dashboard</h1>

<div class="cards">

    <div class="card blue">
        <div class="icon">👤</div>
        <h2><?= $p['c'] ?></h2>
        <p>Passengers</p>
    </div>

    <div class="card green">
        <div class="icon">✈</div>
        <h2><?= $f['c'] ?></h2>
        <p>Flights</p>
    </div>

    <div class="card orange">
        <div class="icon">🎫</div>
        <h2><?= $b['c'] ?></h2>
        <p>Bookings</p>
    </div>

</div>

</div>
</body>
</html>