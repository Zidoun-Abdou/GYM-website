<?php

require 'database.php';

if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}

$text2Error = $text1Error  = $imageError = $text2 = $text1 = $image = "";

if(!empty($_POST))
{
    $text2               = checkInput($_POST['text2']);
    $text1        = checkInput($_POST['text1']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../img/'. basename($image);
    $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
    $isSuccess          = true;

    if(empty($text2))
    {
        $text2Error = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if(empty($text1))
    {
        $text1Error = 'Ce champ ne peut pas être vide';
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
            $statement = $db->prepare("UPDATE persons  set text2 = ?, text1 = ?, image = ? WHERE id = ?");
            $statement->execute(array($text2,$text1,$image,$id));
        }
        else
        {
            $statement = $db->prepare("UPDATE persons  set text2 = ?, text1 = ? WHERE id = ?");
            $statement->execute(array($text2,$text1,$id));
        }
        Database::disconnect();
        header("Location: indexstars.php");
    }
    else if($isImageUpdated && !$isUploadSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM persons where id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $image          = $item['image'];
        Database::disconnect();

    }
}
else
{
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM persons where id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $text2           = $item['text2'];
    $text1    = $item['text1'];
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
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>Update Star</strong></h1>
            <br>
            <form class="form" action="<?php echo 'updatestars.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="text2">text2:
                        <input type="text" class="form-control" id="text2" name="text2" placeholder="text2" value="<?php echo $text2;?>">
                        <span class="help-inline"><?php echo $text2Error;?></span>
                </div>
                <div class="form-group">
                    <label for="text1">text1:
                        <input type="text" class="form-control" id="text1" name="text1" placeholder="text1" value="<?php echo $text1;?>">
                        <span class="help-inline"><?php echo $text1Error;?></span>
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
                    <a class="btn btn-primary" href="indexstars.php"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>
                </div>
            </form>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img src="<?php echo '../img/'.$image;?>" alt="...">
            </div>
        </div>
    </div>
</div>
</body>
</html>
