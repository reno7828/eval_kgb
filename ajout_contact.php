<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>KGB</title>
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




    <?php
    session_start();
    $role = $_SESSION['role'];
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        // Rediriger l'utilisateur vers une page d'erreur ou de connexion
        header('Location: admin.php');
        exit;
    }

    ?>

    <?php

    require_once 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];
        $nom_code = $_POST['nom_code'];
        $nationalite = $_POST['nationalite'];




        // Insertion des données dans la table agents
        $req = $pdo->prepare('INSERT INTO contact(nom, prenom, date_naissance, nom_code, nationalite) VALUES(:nom, :prenom, :date_naissance, :nom_code, :nationalite)');
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance,
            'nom_code' => $nom_code,
            'nationalite' => $nationalite

        ));
    }
    ?>

    <div class="form_contact">

        <form action="ajout_contact.php" method="POST">
            <h2><strong>Ajouter un contact</strong></h2>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            <br><br>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
            <br><br>
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" required>
            <br><br>
            <label for="nom_code">Nom de code :</label>
            <input type="text" id="nom_code" name="nom_code" required>
            <br><br>
            <label for="nationalite">Nationalité :</label>
            <input type="text" id="nationalite" name="nationalite" required>
            <br><br>

            <button type="submit" class="btn btn-primary">Ajouter</button>

            <button type="button" onclick="window.location.href='dashboard_admin.php'" class="btn btn-secondary">Retour</button>
        </form>
    </div>




    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5iy6p16f92r&amp;m=1c&amp;c=d8ff70&amp;cr1=ff0000&amp;f=arial&amp;l=49&amp;bv=70&amp;hi=50&amp;he=6&amp;hc=00ff28&amp;rs=100&amp;as=100&amp;cr0=ff8a00&amp;cw=06cc00&amp;cb=000000" async="async"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>