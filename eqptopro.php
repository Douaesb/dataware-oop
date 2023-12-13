<?php
require('connection.php');

if (isset($_POST['sbmt'])) {
    $id_equipe = $_POST['id_equipe'];
    $id_pro = $_POST['id_pro']; 

    // Create a prepared statement
    $updateQuery = "UPDATE equipe
                    SET id_pro = ?
                    WHERE id_equipe = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);

    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "ii", $id_pro, $id_equipe);

    // Execute the statement
    $updateResult = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($updateResult) {
        header('Location: dashboards.php');
    } else {
        // Handle the error if needed
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
