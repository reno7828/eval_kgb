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
    session_start();
    if (isset($_SESSION["prenom"])) {
    } else {
        header("Location: login.php");

        exit;
    }
    ?>


    <div class="missionsAgent">
        <div class="card-accueil">
            <h2>Informations agent connecté</h2>
        </div>
        <div class="card-accueil-body">
            <?php
            require_once 'config.php';


            // Récupération des informations de l'agent
            $requete = $pdo->prepare('SELECT * FROM agents WHERE prenom = :prenom');
            $requete->bindParam(':prenom', $_SESSION['prenom']);
            $requete->execute();
            $agent = $requete->fetch(PDO::FETCH_ASSOC);

            ?>
            <div id="textPresentation" class="presentation">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <br>
                <script>
                    let texte = document.getElementById("textPresentation").querySelectorAll("li");
                    let contenu = [
                        "Prénom : <?php echo $agent['prenom']; ?>",
                        "Nationalité : <?php echo $agent['nationalite']; ?>",
                        "Né(e) le : <?php echo $agent['date_naissance']; ?>",
                        "Agent numero : <?php echo $agent['id']; ?>"
                    ];

                    for (let i = 0; i < texte.length; i++) {
                        let j = 0;
                        let intervalId = setInterval(function() {
                            if (j < contenu[i].length) {
                                texte[i].innerHTML += contenu[i][j];
                                j++;
                            } else {
                                clearInterval(intervalId);
                            }
                        }, 75);
                    }
                </script>
            </div>

        </div>
    </div>




    <div class="accueil-button">
    <button class="button" onclick="window.location.href = 'consultation.php';">Consulter ma future mission</button>

    </div>




    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5iy6p16f92r&amp;m=1c&amp;c=d8ff70&amp;cr1=ff0000&amp;f=arial&amp;l=49&amp;bv=70&amp;hi=50&amp;he=6&amp;hc=00ff28&amp;rs=100&amp;as=100&amp;cr0=ff8a00&amp;cw=06cc00&amp;cb=000000" async="async"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>