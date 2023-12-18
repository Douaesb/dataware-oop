<?php
include 'project.php'; 
include 'User.php'; 
include 'ProductOwner.php'; 
include 'database.php';  

$db = new Database();
$conn = $db->getConn();

$productOwner = new ProductOwner($conn);
$project = new Projet($conn);
if (isset($_GET['id_pro'])) {
    $idpro = $_GET['id_pro'];

    if (isset($_POST['editprojects'])) {
        $name = $_POST['nom_pro'];
        $descrp = $_POST['descrp_pro'];
        $productOwner->editProject($idpro, $name, $descrp);
        header("Location: dashboardp.php");
        exit();
    }

    $projectDetails = $project->getProject($idpro);
 
} else {
    echo "Project ID is missing.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>DataWare</title>
</head>

<body>
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">
            <div>
            <form action="" method="post" class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                    <div>
                        <input type="hidden" name="id_pro" value="<?php echo $projectDetails['id_pro']; ?>">
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">Nom projet</label>
                        <div class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm">
                            <input type="text" name="nom_pro" value="<?php echo $projectDetails['nom_pro']; ?>" id="" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm">
                        </div>
                    </div>
                    <div>
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">Description du projet</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <textarea name="descrp_pro" id="" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"><?php echo $projectDetails['descrp_pro']; ?></textarea>
                        </div>
                    </div>

                    <button type="submit" name="editprojects" class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Save changes</button>
                    <div class="">
                        <button type="submit" name="submit" class="block py-2 px-3 text-pink-500 font-bold rounded hover:bg-blue-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                            <a href="dashboardp.php" class="">Retour</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
