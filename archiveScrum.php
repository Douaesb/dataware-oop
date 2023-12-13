<?php
include "connection.php";

if (isset($_GET["id_qst"])) {
    $id_qst = $_GET['id_qst'];

    // Get the current archive status
    $getStatutQuery = "SELECT archive_qst FROM question WHERE id_qst = ?";
    $stmt = mysqli_prepare($conn, $getStatutQuery);
    mysqli_stmt_bind_param($stmt, "i", $id_qst);
    mysqli_stmt_execute($stmt);
    $resultArchive = mysqli_stmt_get_result($stmt);

    if ($resultArchive) {
        $row = mysqli_fetch_assoc($resultArchive);
        $currentArchiv = $row['archive_qst'];

        $newArchiv = ($currentArchiv == 1) ? 0 : 1;

        // Update the archive status in the question table
        $reqSolution = "UPDATE question SET archive_qst = ? WHERE id_qst = ?";
        $stmt = mysqli_prepare($conn, $reqSolution);
        mysqli_stmt_bind_param($stmt, "ii", $newArchiv, $id_qst);
        $resultSolution = mysqli_stmt_execute($stmt);

        // Update the archive status in the reponse table
        $resultA = "UPDATE reponse SET archive_rep = ? WHERE id_qst = ?";
        $stmt = mysqli_prepare($conn, $resultA);
        mysqli_stmt_bind_param($stmt, "ii", $newArchiv, $id_qst);
        $res = mysqli_stmt_execute($stmt);

        if ($resultSolution && $res) {
            header('Location: newpage.php');
            exit(); // Ensure to stop the script after redirection
        } else {
            echo "Error updating database: " . mysqli_error($conn);
        }
    } else {
        echo "Error retrieving current status: " . mysqli_error($conn);
    }
}
?>
