<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create a prepared statement
    $updateQuery = "UPDATE utilisateur
                    SET role = 'membre'
                    WHERE id = ?";

    $stmt = mysqli_prepare($conn, $updateQuery);

    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    $updateResult = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($updateResult) {
        header('Location: dashboardp.php');
    } else {
        // Handle the error if needed
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);
?>
