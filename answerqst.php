 <?php 

 include('connection.php');
 if (isset($_POST['answerqst'])) {

if (isset($_POST['descrp_rep'])) {
    $d =  $_POST['descrp_rep'];
}


$ida = $_SESSION['id'];
$idqst = $_POST['id_qst'];

$sql = "INSERT INTO reponse (descrp_rep, date_rep, id_user,id_qst) VALUES (?, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'),?,?)";
$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"sii",$d,$ida,$idqst);
$result = mysqli_stmt_execute($stmt);
if ($result) {
    header('Location: newpage.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
}
