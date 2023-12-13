<?php
include('connection.php');

$name = $date = "";
if (isset($_POST['submit'])) {
    if (isset($_POST['nom_equipe'])) {
        $name = $_POST['nom_equipe'];
    }
    if (isset($_POST['date_creation'])) {
        $date = $_POST['date_creation'];
    }

    $sql = "INSERT INTO equipe (nom_equipe, date_creation) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $name, $date);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header('Location: dashboards.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // mysqli_stmt_close($stmt);
}

// mysqli_close($conn);
?>
