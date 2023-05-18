<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>KGB-Admin</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">KGB</a>
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




    <body>

        <?php
        session_start();
        $_SESSION['role'] = 'admin';
        // Connexion à la base de données
        $host = 'localhost'; // ou '127.0.0.1'
        $dbname = 'kgbnew';
        $user = 'root';
        $pass = '';
        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nom = $_POST['nom'];

            $mot_de_passe = $_POST['mot_de_passe'];


            // Requête pour récupérer les informations de l'administrateur
            $stmt = $db->prepare("SELECT * FROM admin WHERE nom = ?");
            $stmt->debugDumpParams();
            $stmt->execute([$nom]);
            $admin = $stmt->fetch();
            var_dump(password_hash($mot_de_passe, PASSWORD_BCRYPT));



            // Vérifier si l'administrateur existe et si le mot de passe est correct
            if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
                // Connexion réussie, rediriger l'administrateur vers la page d'accueil
                $_SESSION['admin_id'] = $admin['id'];
                header("Location: dashboard_admin.php");
                die();
            } else {
                // Afficher un message d'erreur si l'administrateur n'a pas pu se connecter
                $message = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
        ?>



        <div class="connect_admin">
            <?php if (isset($message)) {
                echo "<p>$message</p>";
            } ?>
            <form method="post" action="">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required><br>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>
                <input type="submit" value="Se connecter">
            </form>

        </div>


        <h1 id="textLog" style="color: #b0f2b6;">Connexion à votre espace admin :</h1>
        <?php if (isset($message)) {
            echo "<p>$message</p>";
        } ?>
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