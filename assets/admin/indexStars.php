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
                    <li class="nav-item">
                        <a href="indexClasses.php" class="nav-link">Classes</a>
                    </li>
                    <li class="nav-item active">
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
<div class="container admin">
    <div class="row">
        <h1><strong>List of stars </strong><a href="insertStars.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Add</a></h1>
        <table class="table table-stripped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require 'database.php';
            $db = Database::connect();
            $statement = $db->query('SELECT persons.text1, persons.text2, persons.id
                                              FROM   persons
                                              ORDER BY persons.id DESC    
                                    ');
            while ($class = $statement->fetch())
            {
                echo '<td>' . $class['text1'] . '</td>';
                echo '<td>' . $class['text2'] . '</td>';
                echo '<td width="300">';
                echo '<a href="viewStars.php?id=' . $class['id'] . '" class="btn btn-warning">verify</a>';
                echo ' ';echo ' ';
                echo '<a href="updateStars.php?id=' . $class['id'] . '" class="btn btn-primary"> update</a>';
                echo ' ';echo ' ';
                echo '<a href="deleteStars.php?id=' . $class['id'] . '" class="btn btn-danger"> delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>