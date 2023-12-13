<?php
include('connection.php');

$name = $desc = $msg = "";
if (isset($_POST['submit'])) {
    if (isset($_POST['nom_pro'])) {
        $name =  $_POST['nom_pro'];
    }
    if (isset($_POST['descrp_pro'])) {
        $desc =  $_POST['descrp_pro'];
    }
    $sql = "INSERT INTO  projet (nom_pro, descrp_pro ) VALUES (?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$name,$desc);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
      header('Location: dashboardp.php');
    }
}
?>

