<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.3">
    <title>MaintenanceApp</title>
</head>
<body>
    <div class="container">
    <form class="formulaire" action="upload.php" method="post" enctype="multipart/form-data">
        <h1>EPSILON</h1>
        <p>Plateforme de peer-learning</p>
        <p> EPSI Lille  </p>
        <img src="./melvin.jfif" alt="logo" class="jokair">
        <p> Melvin Malagowski </p>
        <p> Groupe : Alexis, Bastien </p>
        
        <input class="input-upload" type="file" name="fileToUpload" id="fileToUpload">
        <button type="submit" name="submit" >Upload File</button>
    </form>
    </div>
</body>
</html>