<?php
require('connection.php');

if (isset($_POST['submits'])) {
    $id_projet = $_POST['projet'];
    $id_utilisateur = $_POST['id']; 
    $role = 'ScrumMaster';

    $updateQuery = "UPDATE utilisateur
                    SET  role = ?, projet = ?
                    WHERE id = ?";
    $stmt = mysqli_prepare($conn,$updateQuery);
    mysqli_stmt_bind_param($stmt,"sii",$role,$id_projet,$id_utilisateur);
    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        header('Location: dashboardp.php');
    }
}
?>


  

