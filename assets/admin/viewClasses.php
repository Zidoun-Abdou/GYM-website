<?php
require 'database.php';

if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT classes.id, classes.name, classes.max, classes.price, classes.image
                                                      FROM   classes
                                                      where classes.id = ?');

$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();




function checkInput($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
?>

<!DOCTYPE html>
<html>
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
        <a href="#" class="navbar-brand font-weight-bold font-italic">
            <span class="text-danger text-center">Gym</span>pus
        </a>
    </nav>
</header>
<div class="container">
    <br>
    <h1 class="text-center"><strong>See a Class</strong></h1>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>See an item</strong></h1>
            <br>
            <form action="">
                <div class="form-group">
                    <label>Name:</label><?php  echo ' ' . $item['name']; ?>;
                </div>
                <div class="form-group">
                    <label>Max persons :</label><?php  echo ' ' . $item['max']; ?>;
                </div>
                <div class="form-group">
                    <label>Image:</label><?php  echo ' ' . $item['image']; ?>;
                </div>
            </form>
            <div class="form-actions">
                <a href="indexStars.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>
            </div>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img src="<?php echo '../img/' . $item['image'] ; ?>" alt="...">
                <div class="price"><?php  echo ' ' . number_format((float)$item['price'],2,'.','') . ' $' ?></div>
            </div>
        </div>

    </div>
</div>

</body>

</html>

