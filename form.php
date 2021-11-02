<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $uploadDir = 'public/uploads/';

    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

    $authorizedExtensions = ['jpg','jpeg','png' ,'webp'];

    $maxFileSize = 1000000;

    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png  ou webp!';
    }
    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }else {
        $uploadFile = uniqid('', true) . '.' . $extension;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        echo '<img src="' . $uploadFile . '">';
    }

}
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="description" content="">
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="name" id="name" placeholder="Donnes-nous ton nom">
    <label for="imageUpload">Upload an profile image</label>
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Send</button>
</form>
</body>
</html>
