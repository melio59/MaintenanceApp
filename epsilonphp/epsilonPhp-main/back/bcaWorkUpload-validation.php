<?php

include('header.php');

/* 
TODO : 
Ajout de plusieurs fichiers
*/


$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;
if ($isConnected) {
  $mail = isset($_COOKIE['mail']) ? $_COOKIE['mail'] : $_SESSION['mail'];
}
else{
  echo 'Vous n\'êtes pas connecté, veuillez vous inscrire ou vous connecter sur la page d\'accueil<br><a href="index.php">Retour</a>';
  exit();
}

function getIdUser(){
  require('env.php');
  global $mail;
  $select = $db->query('SELECT id FROM user WHERE mail="'.$mail.'"');
  $result = $select->fetch();
  $counttable = count((is_countable($result)?$result:[]));
  if($counttable!=0){
      return $result['id'];
  }
  else{
    return 'erreur req';
  }
}

$idUser = getIdUser();

if(!is_dir($idUser)){
  mkdir($idUser, 0777);
}

$nameOfDirForWork = $_GET['course'].' '.$_GET['challenge'];
$target_dir = $idUser.'/'.$nameOfDirForWork;

if(!is_dir($target_dir)){
  mkdir($target_dir, 0777);
}

// Boucle pour gérer le téléchargement de plusieurs fichiers
if(isset($_FILES["fileToUpload"])) {
    $numFiles = count($_FILES["fileToUpload"]["name"]);

    for ($i = 0; $i < $numFiles; $i++) {
        $target_file = $target_dir .'/'. basename($_FILES["fileToUpload"]["name"][$i]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Vérifier si le fichier existe déjà
        if (file_exists($target_file)) {
            echo "Désolé, le fichier " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"][$i])) . " existe déjà.";
            $uploadOk = 0;
        }

        // Vérifier la taille du fichier
        if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
            echo "Désolé, votre fichier " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"][$i])) . " est trop gros";
            $uploadOk = 0;
        }

        // Autoriser certains formats de fichier
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "ppt" && $imageFileType != "pptx") {
            echo "Désolé, seuls les fichiers JPG, JPEG, PNG, GIF, PDF, PPT & PPTX sont autorisés.";
            $uploadOk = 0;
        }

        // Vérifier si $uploadOk est défini sur 0 en cas d'erreur
        if ($uploadOk == 0) {
            echo " Votre fichier " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"][$i])) . " n'a pas été uploadé.";
        // Si tout est OK, essayer de télécharger le fichier
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                echo "Le fichier ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " a été uploadé.";
            } else {
                echo "Désolé, il y a eu une erreur durant l'upload.";
            }
        }
    }
}

?>

<br>
<a href="index.php">Retour</a>
