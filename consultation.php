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
    if (isset($_SESSION["prenom"])) {
    } else {
        header("Location: login.php");

        exit;
    }
    ?>
    <div class="consultation">

        <?php

        require_once 'config.php';
        echo "Bonjour " . $_SESSION['prenom'];


        // Récupération des informations de l'agent
        $requete = $pdo->prepare('SELECT * FROM agents WHERE prenom = :prenom');
        $requete->bindParam(':prenom', $_SESSION['prenom']);
        $requete->execute();
        $agent = $requete->fetch(PDO::FETCH_ASSOC);

        $agent_id =  $agent['id'];

        //on a id agent on verifie dans la table mission si id agent est dans agents_id 
        // Requête pour récupérer la mission correspondante à l'agent
        $query = "SELECT * FROM missions WHERE FIND_IN_SET(:agent_id, agents_id)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['agent_id' => $agent_id]);


        //il faut recuperer les contacts en fonction de l'id dans la table missions colonne contacts_id





        // Vérification s'il y a une mission pour l'agent connecté
        if ($stmt->rowCount() > 0) {
            // Récupération des informations de la mission
            $row = $stmt->fetch();
            $mission_id = $row['id'];
            $mission_titre = $row['titre'];
            $mission_description = $row['description'];
            $mission_nom_code = $row['nom_code'];
            $mission_pays = $row['pays'];
            $mission_type = $row['type'];
            $mission_contact = $row['contacts_id'];
            $mission_cible = $row['cibles_id'];
            $mission_planque = $row['planques_id'];
            $mission_debut = $row['date_debut'];
            $mission_fin = $row['date_fin'];


            // On récupère le ou les contacts
            $infoContact = [];
            $query = "SELECT * FROM contact WHERE id IN ($mission_contact)";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($contacts as $contact) {

                $infoContact[] = $contact['nom'] . " " . $contact['prenom'];
            }

            $contactInfo = implode(", ", $infoContact);

            //recuperer id cible
            $infoCible = [];
            $query = "SELECT * FROM cibles WHERE id IN ($mission_cible)";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $cibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($cibles as $cible) {
                $infoCible[] = $cible['nom'] . " " . $cible['prenom'];
            }
            $cibleInfo = implode(", ", $infoCible);

            //recuperer id planque
            $infoPlanque = [];
            $query = "SELECT * FROM planque WHERE id IN ($mission_planque)";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $planques = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($planques as $planque) {
                $infoPlanque[] = $planque['type'] . " " . $planque['adresse'];
            }

            $planqueInfo = implode(", ", $infoPlanque);




            // Affichage des informations de la mission
            echo "<p>Votre prochaine mission :</p>";
            echo "<ul>";

            echo "Titre : $mission_titre</li>";
            echo "<br>";
            echo "Description : $mission_description</li>";
            echo "<br>";
            echo "Nom de code : $mission_nom_code</li>";
            echo "<br>";
            echo "Pays : $mission_pays</li>";
            echo "<br>";
            echo "Type : $mission_type</li>";
            echo "<br>";
            echo "Contact(s) agent(s) : $contactInfo</li>";
            echo "<br>";
            echo "Votre / Vos  cible(s) : $cibleInfo</li>";
            echo "<br>";
            echo "Votre / Vos  planque(s) : $planqueInfo</li>";
            echo "<br>";
            echo "Début de mission : $mission_debut</li>";
            echo "<br>";
            echo "Fin de mission : $mission_fin</li>";
            echo "</ul>";
        } else {
            echo "Pas de mission prévue pour l'agent connecté.";
        }

        ?>


    </div>

    <div class="retourHome">
        <button type="button" onclick="window.location.href='accueil.php'" class="btn btn-secondary">Retour</button>
    </div>



    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5iy6p16f92r&amp;m=1c&amp;c=d8ff70&amp;cr1=ff0000&amp;f=arial&amp;l=49&amp;bv=70&amp;hi=50&amp;he=6&amp;hc=00ff28&amp;rs=100&amp;as=100&amp;cr0=ff8a00&amp;cw=06cc00&amp;cb=000000" async="async"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>