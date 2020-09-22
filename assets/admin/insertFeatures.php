<?php

require 'database.php';

$nameError = $textError = $imageError = $name = $text = $image = "";

if(!empty($_POST))
{
    $name               = checkInput($_POST['name']);
    $text                = checkInput($_POST['text']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../img/'. basename($image);
    $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = false;

    if(empty($name))
    {
        $nameError = 'This field can not be empty';
        $isSuccess = false;
    }
    if(empty($text))
    {
        $textError = 'This field can not be empty';
        $isSuccess = false;
    }
    if(empty($image))
    {
        $imageError = 'This field can not be empty';
        $isSuccess = false;
    }
    else
    {
        $isUploadSuccess = true;
        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
        {
            $imageError = "Only those types of images are available: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if(file_exists($imagePath))
        {
            $imageError = "This file already exists";
            $isUploadSuccess = false;
        }
        if($_FILES["image"]["size"] > 500000)
        {
            $imageError = "The size of the file can't be more than 500KB";
            $isUploadSuccess = false;
        }
        if($isUploadSuccess)
        {
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
            {
                $imageError = "There is an error in the upload";
                $isUploadSuccess = false;
            }
        }
    }

    if($isSuccess && $isUploadSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO featurs (image,name,text) values(?, ?, ?)");
        $statement->execute(array($image,$name,$text));
        Database::disconnect();
        header("Location: indexFeatures.php");
    }
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
    <h1 class="text-center"><strong>Add a feature</strong></h1>
    <br>
    <div class="row">
        <form action="" class="form" role="form" action="insertFeatures.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $name; ?>">
                <span class="help-inline"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
                <label for="text">Text:</label>
                <input type="text" class="form-control" id="text" placeholder="please insert a text" name="text" value="<?php echo $text; ?>">
                <span class="help-inline"><?php echo $textError; ?></span>
            </div>
            <div class="form-group">
                <label for="image">Select an image:</label>
                <input type="file"  id="image"  name="image">
                <span class="help-inline"><?php echo $imageError; ?></span>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"></span> Add</button>
                <a href="indexFeatures.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>
            </div>
        </form>
    </div>
</div>

</body>

</html>
