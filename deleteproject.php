<?php
include "connection.php";

if (isset($_GET['id_pro'])) {
    $id = $_GET['id_pro'];

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM projet WHERE id_pro = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header('Location: dashboardp.php');
            exit();  // Ensure to stop the script after redirection
        } else {
            // Handle the error, e.g., display an error message or log it
            echo "Error deleting from database: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
         // Handle the error if preparing the statement fails
         echo "Error: Unable to prepare the statement.";
        }
    
        mysqli_close($conn);
    }
    ?>