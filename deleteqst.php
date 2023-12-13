<?php
include "connection.php";

if (isset($_GET['id_qst'])) {
    $id = $_GET['id_qst'];

    // Create a prepared statement
    $sql = "DELETE FROM question WHERE id_qst = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($result == TRUE) {
        header('Location: newM.php');
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
