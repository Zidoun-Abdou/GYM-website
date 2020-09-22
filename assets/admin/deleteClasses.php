<?php
require 'database.php';

if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}

if(!empty($_POST))
{
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM classes WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: indexClasses.php");
}

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYMPUS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/4bea204677.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body  style="background-color: snow">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-md-3 py-0" id="navbar">
        <div class="container">
            <a href="#" class="navbar-brand font-weight-bold font-italic">
                <span class="text-danger">Gym</span>pus
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav ml-auto font-weight-bolder text-uppercase">
                    <li class="nav-item active">
                        <a href="indexClasses.php" class="nav-link">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a href="indexStars.php" class="nav-link">Sport Stars</a>
                    </li>
                    <li class="nav-item">
                        <a href="indexFeatures.php" class="nav-link">Features</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="container">
    <h1><strong class="text-center">Delete Classe</strong></h1>

    <div class="row">
        <br>
        <form class="form" action="deleteClasses.php" role="form" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-warning">Are you sur that you want to delete ?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning">Yes</button>
                <a class="btn btn-default" href="indexClasses.php">No</a>
            </div>
        </form>
    </div>
</div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>