<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img {
            max-width: 100%;
            height: auto;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: transparent;
            background-image: linear-gradient(to top, #fff0 0%, #fff 100%);
        }




    </style>
</head>
<body>
<?php
session_start(); 

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    if($imageFileType == "pdf") {
        $uploadOk = 1;
    } else {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
}

if (file_exists($target_file)) {
    echo "Désolé, fichiers déjà existants.";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 1500000) {
    echo "Désolé, fichiers trop grands.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf"  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Désolé, votre fichier n'a pas été upload.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $_SESSION['uploaded_file'] = $target_file;
        echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a bien été téléchargé.";
    } else {
        echo "Désolé, erreur .";
    }
}

if (isset($_SESSION['uploaded_file']) && file_exists($_SESSION['uploaded_file'])) {
    if ($imageFileType == "pdf") {
        echo '<embed src="'.$_SESSION['uploaded_file'].'" type="application/pdf" width="100%" height="600px" />';
    } else {
        echo '<img src="'.$_SESSION['uploaded_file'].'" alt="Uploaded Image">';
    }
} else {
    echo 'No file has been uploaded.';
}
?>
</body>
</html>
