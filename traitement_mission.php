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


    <?php
    require_once 'config.php';

    // Vérifier si la variable $_POST["pays"] existe et n'est pas vide
    if (isset($_POST["pays"]) && !empty($_POST["pays"])) {
        // Récupérer la valeur du champ "pays"
        $pays = $_POST["pays"];
        // Utiliser la variable $pays dans votre traitement

    } else {
    }

    // Vérifier si la variable $_POST["specialites"] existe et n'est pas vide
    if (isset($_POST["specialites"]) && !empty($_POST["specialites"])) {
        // Récupérer la valeur du champ "specialites"
        $specialites = $_POST["specialites"];
        // Utiliser la variable $specialites dans votre traitement

    } else {
    }

    // 1 contact obligatoirement du meme pays => recuperer les contacts dans la bdd


    // Préparation de la requête SQL
    $stmt = $pdo->prepare("SELECT * FROM contact WHERE nationalite = '$pays' ORDER BY RAND() LIMIT " . rand(1, 2));




    // Exécution de la requête SQL
    $stmt->execute();

    // Récupération des résultats de la requête SQL sous forme de tableau associatif
    $resultsContact = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    foreach ($resultsContact as $result) {

        $contact_choice =  $result['id'];
    }

    // 2 planque meme pays
    // Préparation de la requête SQL
    $stmt = $pdo->prepare("SELECT * FROM planque WHERE pays = '$pays' ORDER BY RAND() LIMIT " . rand(1, 2));



    // Exécution de la requête SQL
    $stmt->execute();

    // Récupération des résultats de la requête SQL sous forme de tableau associatif
    $resultsPlanque = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    foreach ($resultsPlanque as $result) {

        $planque_choice =  $result['id'];
    }


    $cible_ids = [];
    $stmt = $pdo->prepare("SELECT * FROM cibles ORDER BY RAND() LIMIT " . rand(1, 3));
    // Exécution de la requête SQL
    $stmt->execute();
    // Récupération des résultats de la requête SQL sous forme de tableau associatif
    $resultsCibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Boucle sur les résultats
    foreach ($resultsCibles as $result) {
        // Ajout de l'id de la cible au tableau
        $cible_ids[] = $result['id'];
    }

    // Affichage des id des cibles séparés par une virgule
    $cible_choice = implode(", ", $cible_ids);


    // Construction de la requête SQL avec une liste de paramètres placeholders
    $placeholders = implode(',', array_fill(0, count($cible_ids), '?'));
    $stmt = $pdo->prepare("SELECT nationalite FROM cibles WHERE id IN ($placeholders)");

    // Exécution de la requête SQL avec les valeurs de $agent_ids en tant que paramètres
    $stmt->execute($cible_ids);

    // Récupération des résultats de la requête SQL sous forme de tableau associatif
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $cible_natios = [];

    // Boucle sur les résultats pour afficher les nationalités
    foreach ($results as $result) {

        $cible_natios[] = $result['nationalite'];
    }

    // Construction de la chaîne de caractères contenant toutes les nationalités séparées par une virgule
    $cible_natio = "'" . implode("', '", $cible_natios) . "'";


    //parmi les agents selectionnés il faut au moins 1 agent avec la spécialité de la mission
    $agent_ids = [];
    $stmt = $pdo->prepare("SELECT * FROM agents WHERE nationalite NOT IN ($cible_natio) ORDER BY RAND() LIMIT " . rand(1, 2));


    // Exécution de la requête SQL
    $stmt->execute();

    // Récupération des résultats de la requête SQL sous forme de tableau associatif
    $resultsAgent = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Boucle sur les résultats
    foreach ($resultsAgent as $result) {


        // Ajout de l'id de l'agent au tableau


        $agent_ids[] = $result['id'];
    }

    // Affichage des id des agents séparés par une virgule

    $agent_choice = implode(", ", $agent_ids);



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données du formulaire
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $nom_code = $_POST['nom_code'];
        $pays = $_POST['pays'];
        $type = $_POST['type'];
        $statut = $_POST['statut'];
        $choix_contact = isset($_POST[$contact_choice]) ? implode(', ', $_POST[$contact_choice]) : null;
        $choix_planque = isset($_POST[$planque_choice]) ? implode(', ', $_POST[$planque_choice]) : null;
        $choix_cible = isset($_POST[$cible_choice]) ? implode(', ', $_POST[$cible_choice]) : null;
        $choix_agent = isset($_POST[$agent_choice]) ? implode(', ', $_POST[$agent_choice]) : null;
        $specialites = isset($_POST['specialites']) ? implode(', ', $_POST['specialites']) : null;
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
    };

    // Insertion des données dans la table agents
    $req = $pdo->prepare('INSERT INTO missions(titre, description, nom_code, pays, agents_id, contacts_id, cibles_id, type, statut, planques_id, specialite, date_debut, date_fin) VALUES(:titre, :description, :nom_code, :pays, :agents_id, :contacts_id, :cibles_id, :type, :statut, :planques_id, :specialite, :date_debut, :date_fin)');
    $req->execute(array(
        'titre' => $titre,
        'description' => $description,
        'nom_code' => $nom_code,
        'pays' => $pays,
        'agents_id' => $agent_choice,
        'contacts_id' => $contact_choice,
        'cibles_id' => $cible_choice,
        'type' => $type,
        'statut' => $statut,
        'planques_id' => $planque_choice,
        'specialite' => $specialites,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin
    ));




    ?>



    <div class="succes">
        <h1>Mission inséré avec succés!!</h1>
    </div>
    <br>
    <br>
    <div class="retour_dashboard">
        <a href="dashboard_admin.php" class="btn btn-primary">Retour au tableau de bord</a>


    </div>





    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5iy6p16f92r&amp;m=1c&amp;c=d8ff70&amp;cr1=ff0000&amp;f=arial&amp;l=49&amp;bv=70&amp;hi=50&amp;he=6&amp;hc=00ff28&amp;rs=100&amp;as=100&amp;cr0=ff8a00&amp;cw=06cc00&amp;cb=000000" async="async"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>