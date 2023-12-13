<?php
require('connection.php');

if (isset($_GET['id_equipe'])) {
    $id = $_GET['id_equipe'];

    // Use a prepared statement to avoid SQL injection
    $updateQuery = "UPDATE equipe
                    SET id_pro = '1'
                    WHERE id_equipe = ?";

    // Initialize a prepared statement
    $stmt = mysqli_prepare($conn, $updateQuery);

    // Bind the parameter to the statement
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    $updateResult = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    if ($updateResult) {
        header('Location: dashboards.php');
    } else {
        // Handle the error, e.g., display an error message or log it
        echo "Error updating the database";
    }
}
?>
