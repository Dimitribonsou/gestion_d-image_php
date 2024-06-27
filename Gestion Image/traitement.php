<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css">
    <title>Se Connecter</title>
</head>

<body>

    <div class="login-form">
        <img src="images/storm.jpg" alt="profil" width="50%">
        <h2>Connectez Vous</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nom">Username</label>
            <input type="text" id="nom d'utilisateur" name="nom"><br>
            <label for="mdp">prenom</label>
            <input type="text" id="MDP" name="mdp"><br>
            <label for="quartier">quartier</label>
            <input type="text" id="quartier" name="quartier"><br>
            <label for="tel">Telephone</label>
            <input type="text" id="tel" name="tel" ><br>
            <label for="im">Image</label>
            <input type="file" id="image" name="image" required><br>
            <a href="#">Mot de passe oublier?</a><br><br>
            <button type="submit" name="send">Login</button>
            <P>Je n'ai pas de compte?<a href="#">Creer un compte</a></P>
        </form>
    </div>
    <?php


    $serveur = "localhost";
    $db = "data";
    $login = "root";
    $pass = "dimi123";
    $filename = $nom = '';

    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=" . $db . ";", $login, $pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
       
        // echo "Connection a la BD reussi";
        if (isset($_POST["send"]) ) {

            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];
                if ($file['error'] === UPLOAD_ERR_OK) {
                    echo "File uploaded successfully: " . $file['name'];
                    $name = $_POST["nom"];
                    $pass = $_POST["mdp"];
                    $quat = $_POST["quartier"];
                    $tel = $_POST["tel"];
                    // $nom = htmlspecialchars($_POST['image']);
                    $filename = $file['name'];
                    $tmpname = $file['tmp_name'];
                    $destination = "Images/" . $filename;
                    // echo " ". $filename;
                    $imagePath = pathinfo($filename, PATHINFO_EXTENSION);
                    $valid_extension = array("jpg", "jpeg", "png");
        
                   
                    if (!in_array(strtolower($imagePath), $valid_extension)) {
                      
                    }
                    if (!move_uploaded_file($tmpname, $destination)) {
                        echo "<h2>Image non importé </h2>";
                    } else {
                        echo "<h2>Image importé</h2>";
                    }
        
                    $insertion = "INSERT INTO userdata (username,prenom,quartier,téléphone,Images) VALUES (:nam,:pass,:quat,:tel,:nom) ";
                    $ted=$connexion->prepare($insertion);
                    $ted->bindParam(':nam',$name);
                    $ted->bindParam(':pass',$pass);
                    $ted->bindParam(':quat',$quat);
                    $ted->bindParam(':tel',$tel);
                    $ted->bindParam(':nom',$filename);
        
                    $isExec=$ted->execute();

                } else {
                    echo "Error uploading file: " . $file['error'];
                }
                } else {
                echo "No file uploaded.";
                }
    
            
       

            
            //move_uploaded_file($tmpname,$destination);
            //header("location:taff.php");
        }
      
    } catch (Exception $e) {
        echo "" . $e->getMessage() . "";
    }



    ?>
</body>

</html>