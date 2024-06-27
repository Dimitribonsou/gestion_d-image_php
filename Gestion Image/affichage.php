  
<?php


$serveur = "localhost";
$db = "data";
$login = "root";
$pass = "dimi123";
$filename = $nom = '';

    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=" . $db . ";", $login, $pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $req="SELECT * FROM userdata ORDER BY username ASC";
        $requete=$connexion->prepare($req);
        // execution de la requete
        $requete->execute();
        // recuper les resultat de la requete
        $resultat=$requete->fetchall();

    } catch (Exception $e) {

        echo "" . $e->getMessage() . "";

    }



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css">
    <title>Se Connecter</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Affichage des informations </h1>
  <div class="container">
 <?php
 if( count($resultat))
 {
    foreach($resultat as $user)
    {
      ?>
      <div class="affige-block">
          <div class="left">
              <img src="Images/<?php echo $user["Images"]?>" alt="image user">
          </div>
          <div class="right">
              <h3><?php echo $user["username"]?></h3>
              <h3><?php echo $user["prenom"]?></h3>
              <span><?php echo $user["quartier"]?></span>
              <span><?php echo $user["téléphone"]?></span>
          </div>
      </div>
      <?php
    }
}
else
{
    ?>
       <p> la base de donnee est vide !!</p>
    <?php
}
  ?>

  </div>

</body>

</html>
 