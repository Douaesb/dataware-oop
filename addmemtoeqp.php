<?php
require('connection.php');

if (isset($_POST['send'])) {
    $id_utilisateur = intval($_POST['id']);  // Use intval() to ensure it's an integer
    $id_equipe = intval($_POST['equipe']);  // Use intval() to ensure it's an integer

    // Use prepared statement to prevent SQL injection
    $selectEquipeQuery = "SELECT id_pro FROM equipe WHERE id_equipe = ?";
    $stmt = mysqli_prepare($conn, $selectEquipeQuery);
    mysqli_stmt_bind_param($stmt, "i", $id_equipe);
    mysqli_stmt_execute($stmt);
    $selectEquipeResult = mysqli_stmt_get_result($stmt);

    // Check for errors
    if (!$selectEquipeResult) {
        die("Error: " . mysqli_error($conn));
    }

    if ($row = mysqli_fetch_assoc($selectEquipeResult)) {
        $id_projet = $row['id_pro'];

        // Use prepared statement to prevent SQL injection
        $updateQuery = "UPDATE utilisateur
                        SET equipe = ?, projet = ?
                        WHERE id = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "iii", $id_equipe, $id_projet, $id_utilisateur);
        $updateResult = mysqli_stmt_execute($stmt);

        // Check for errors
        if (!$updateResult) {
            die("Error: " . mysqli_error($conn));
        }

        if ($updateResult) {
            header('Location: dashboards.php');
        }
    }
}
?>



