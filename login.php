<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> *
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <title>KGB</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>

         
          <li class="nav-item">
            <a class="nav-link" href="deconnexion.php">Deconnexion</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <title>Page de connexion</title>

  </head>

  <body>
    <?php
    session_start();
    require_once 'config.php';

    if (isset($_POST['prenom']) && isset($_POST['code_identification'])) {
      $prenom = $_POST['prenom'];
      $code = $_POST['code_identification'];





      // Échapper les entrées de l'utilisateur pour éviter les attaques par injection SQL
      $prenom = htmlspecialchars($prenom);
      $code = htmlspecialchars($code);

      // Exécution d'une requête SELECT sur la table des agents pour vérifier les informations d'identification
      $query = "SELECT * FROM agents WHERE prenom=:prenom";
      $stmt = $pdo->prepare($query);
      $stmt->execute(['prenom' => $prenom]);

      // Vérification si les informations d'identification sont correctes
      if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        $code_hash = $row['code_identification_hash'];
        if (password_verify($code, $code_hash)) {
          // Création d'une session pour l'utilisateur
          session_start();
          $_SESSION['prenom'] = $row['prenom'];

          // Redirection vers la page d'accueil
          header('Location: accueil.php');
          exit();
        } else {
          // Affichage d'un message d'erreur si les informations d'identification sont incorrectes
          $message = "Informations d'identification incorrectes. Veuillez réessayer.";
        }
      } else {
        // Affichage d'un message d'erreur si les informations d'identification sont incorrectes
        $message = "Informations d'identification incorrectes. Veuillez réessayer.";
      }
    }


    ?>

    <!-- Affichage du formulaire de connexion dans une page HTML -->
    <!DOCTYPE html>
    <html>

    <head>
      <title>Connexion à votre espace agent</title>
    </head>

    <body>
      <h1 id="textLog" style="color: #b0f2b6;">Connexion à votre espace agent :</h1>
      <?php if (isset($message)) {
        echo "<p>$message</p>";
      } ?>
      <form method="post" action="">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required><br>
        <label for="code_identification">Code d'identification :</label>
        <input type="password" name="code_identification" id="code_identification" required><br>
        <input type="submit" value="Se connecter">
      </form>



    </body>

    </html>


    <script>
      let texte = document.getElementById("textLog");
      let contenu = texte.innerHTML;
      texte.innerHTML = "";

      for (let i = 0; i < contenu.length; i++) {
        setTimeout(function() {
          texte.innerHTML += contenu[i];
        }, 75 * i);
      }
    </script>

    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5iy6p16f92r&amp;m=1c&amp;c=d8ff70&amp;cr1=ff0000&amp;f=arial&amp;l=49&amp;bv=70&amp;hi=50&amp;he=6&amp;hc=00ff28&amp;rs=100&amp;as=100&amp;cr0=ff8a00&amp;cw=06cc00&amp;cb=000000" async="async"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  </body>

</html>