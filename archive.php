<?php
include "connection.php";

if (isset($_GET["id_rep"])) {
    $id_rep = $_GET['id_rep'];
    echo 'hello';

    $getStatutQuery = "SELECT archive_rep FROM reponse WHERE id_rep = ?";
    $stmt = mysqli_prepare($conn,$getStatutQuery);
    mysqli_stmt_bind_param($stmt,"i",$id_rep);
    mysqli_stmt_execute($stmt);
    $resultArchive = mysqli_stmt_get_result($stmt);

    if ($resultArchive) {
        $row = mysqli_fetch_assoc($resultArchive);
        $currentArchiv = $row['archive_rep'];

        $newArchiv = ($currentArchiv == 1) ? 0 : 1;
        $reqSolution = "UPDATE reponse SET archive_rep = ? WHERE id_rep = ?";
        $stmt = mysqli_prepare($conn,$reqSolution);
        mysqli_stmt_bind_param($stmt,"ii",$newArchiv,$id_rep);
        $resultSolution = mysqli_stmt_execute($stmt);
        if ($resultSolution) {
            header('Location:newpage.php');
        } else {
            echo "Error updating database: " . mysqli_error($conn);
        }
    } else {
        echo "Error retrieving current status: " . mysqli_error($conn);
    }
}
?>