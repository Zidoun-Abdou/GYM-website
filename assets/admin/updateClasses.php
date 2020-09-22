<?php

require 'database.php';

if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}

$nameError = $maxError = $priceError = $imageError = $name = $max = $price = $image = "";

if(!empty($_POST))
{
    $name               = checkInput($_POST['name']);
    $max        = checkInput($_POST['max']);
    $price              = checkInput($_POST['price']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../img/'. basename($image);
    $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
    $isSuccess          = true;

    if(empty($name))
    {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if(empty($max))
    {
        $maxError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if(empty($price))
    {
        $priceError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }


    if(empty($image)) // le input file est vide, ce qui signifie que l'image n'a pas ete update
    {
        $isImageUpdated = false;
    }
    else
    {
        $isImageUpdated = true;
        $isUploadSuccess =true;
        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
        {
            $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if(file_exists($imagePath))
        {
            $imageError = "Le fichier existe deja";
            $isUploadSuccess = false;
        }
        if($_FILES["image"]["size"] > 500000)
        {
            $imageError = "Le fichier ne doit pas depasser les 500KB";
            $isUploadSuccess = false;
        }
        if($isUploadSuccess)
        {
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
            {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }

    if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
    {
        $db = Database::connect();
        if($isImageUpdated)
        {
            $statement = $db->prepare("UPDATE classes  set name = ?, max = ?, price = ?, image = ? WHERE id = ?");
            $statement->execute(array($name,$max,$price,$image,$id));
        }
        else
        {
            $statement = $db->prepare("UPDATE classes  set name = ?, max = ?, price = ? WHERE id = ?");
            $statement->execute(array($name,$max,$price,$id));
        }
        Database::disconnect();
        header("Location: indexClasses.php");
    }
    else if($isImageUpdated && !$isUploadSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM classes where id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $image          = $item['image'];
        Database::disconnect();

    }
}
else
{
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM classes where id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $name           = $item['name'];
    $max    = $item['max'];
    $price          = $item['price'];
    $image          = $item['image'];
    Database::disconnect();
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

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-md-3 py-0" id="navbar">
        <div class="container">
            <a href="#" class="navbar-brand font-weight-bold font-italic">
                <span class="text-danger">Gym</span>pus
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>
<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code <span class="glyphicon glyphicon-cutlery"></span></h1>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>Update classe</strong></h1>
            <br>
            <form class="form" action="<?php echo 'updateClasses.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                </div>
                <div class="form-group">
                    <label for="max">max:
                        <input type="number" class="form-control" id="max" name="max" placeholder="max" value="<?php echo $max;?>">
                        <span class="help-inline"><?php echo $maxError;?></span>
                </div>
                <div class="form-group">
                    <label for="price">Price: (en €)
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Price" value="<?php echo $price;?>">
                        <span class="help-inline"><?php echo $priceError;?></span>
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <p><?php echo $image;?></p>
                    <label for="image">Select a new image:</label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php echo $imageError;?></span>
                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Update</button>
                    <a class="btn btn-primary" href="indexClasses.php"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>
                </div>
            </form>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img src="<?php echo '../img/'.$image;?>" alt="...">
                <div class="price"><?php echo number_format((float)$price, 2, '.', ''). ' €';?></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
