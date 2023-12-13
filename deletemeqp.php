<?php
require('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement to prevent SQL injection
    $updateQuery = "UPDATE utilisateur
                    SET equipe = null, projet = null
                    WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $updateQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        $updateResult = mysqli_stmt_execute($stmt);

        if ($updateResult) {
            header('Location: dashboards.php');
            exit();  // Ensure to stop the script after redirection
        } else {
            // Handle the error, e.g., display an error message or log it
            echo "Error updating database: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle the error if preparing the statement fails
        echo "Error: Unable to prepare the statement.";
    }

    mysqli_close($conn);
}
?>
