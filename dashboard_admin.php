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

    <div class="admin_visu">
        <?php
        session_start();
        require_once 'config.php';

        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT * FROM admin");

        // Exécution de la requête SQL
        $stmt->execute();

        // Récupération des résultats de la requête SQL sous forme de tableau associatif
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            // Boucle pour parcourir chaque ligne de résultat
            foreach ($results as $row) {
                // Construction de la chaîne de caractères à afficher
                $agentInfo = [
                    "Nom : " . $row["nom"],
                    "Prénom : " . $row["prenom"],
                    "Email : " . $row["email"],
                    "Création  : " . $row["date_creation"],
                    "Admin : " . $row["id"]
                ];

                // Ajout d'un élément div contenant les informations de l'agent
                echo "<div class='agent-info'></div>";
                echo "<script>
const agentInfo = " . json_encode($agentInfo) . ";
const delay = 100; // en millisecondes
const parentDiv = document.querySelector('.agent-info');
agentInfo.forEach((info, index) => {
const childDiv = document.createElement('div');
parentDiv.appendChild(childDiv);
setTimeout(() => {
    let i = 0;
    const intervalId = setInterval(() => {
        if (i >= info.length) {
            clearInterval(intervalId);
            return;
        }
        childDiv.innerText += info.charAt(i);
        i++;
    }, delay);
}, delay * (index + 1));
});
</script>";
            }
        } else {
            echo "Aucun agent trouvé.";
        }
        ?>
    </div>
    <br>
    <br>
    <div class="card-admin">
        <h2>Panel d'administration</h2>
        <div class="btn-group">
            <button class="btn" onclick="location.href='ajout_agent.php'">Ajouter un agent</button>
            <button class="btn" onclick="location.href='ajout_cible.php'">Ajouter une cible</button>
            <button class="btn" onclick="location.href='ajout_contact.php'">Ajouter un contact</button>
            <button class="btn" onclick="location.href='ajout_mission.php'">Ajouter une mission</button>
            <button class="btn" onclick="location.href='ajout_planque.php'">Ajouter une planque</button>
        </div>
    </div>



    

</body>

</html>