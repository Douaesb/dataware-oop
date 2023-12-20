 <?php
        include 'project.php';
        include 'User.php';
        include 'ProductOwner.php';
        include 'database.php';
        include 'Member.php';
        include 'ScrumMaster.php';
        $db = new Database();
        $conn = $db->getConn();

        $scrum = new ScrumMaster($conn);
        if (isset($_GET['id_equipe'])) {
            $id_equipe = $_GET['id_equipe'];

            if (isset($_POST['edit'])) {
                $id = $_POST['id_equipe'];
                $name = $_POST['nom_equipe'];
                $date = $_POST['date_creation'];
                $scrum->editSquad($id, $name, $date);
                header("Location: dashboards.php");
                exit();
            }

            $equipeDetails = $scrum->getSquad($id_equipe);
        } else {
            echo "Project ID is missing.";
            exit();
        }
        ?>
        <!doctype html>
        <html lang="eng">

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
                                <input type="hidden" name="id_equipe" value="<?php echo $equipeDetails['id_equipe']; ?>">
                                <label for="" class="block text-sm font-medium leading-6 text-gray-900">Nom Equipe</label>
                                <div class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm">
                                    <input type="text" name="nom_equipe" value="<?php echo $equipeDetails['nom_equipe']; ?>" id="" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm">
                                </div>
                            </div>
                            <div>
                                <label for="" class="block text-sm font-medium leading-6 text-gray-900">Date de Création</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input type="date" name="date_creation" value="<?php echo $equipeDetails['date_creation']; ?>" id="" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm">
                                </div>
                            </div>

                            <button type="submit" name="edit" class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Save changes</button>
                            <div class="">
                                <button type="submit" name="submit" class="block py-2 px-3 text-pink-500 font-bold rounded hover:bg-blue-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"><a href="dashboards.php" class="">Retour</a>
                                </button>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </body>

        </html>

