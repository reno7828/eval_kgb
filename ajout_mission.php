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

   


    <div class="form_misison">

        <form action="traitement_mission.php" method="POST">
            <h2><strong>Ajouter une mission</strong></h2>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required>
            <br><br>
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="4" cols="30"></textarea>
            <br><br>
            <label for="nom_code">Nom de code :</label>
            <input type="text" id="nom_code" name="nom_code" required>
            <br><br>
            <label for="pays">Pays :</label>
            <input type="text" id="pays" name="pays" required>
            <br><br>
            <label for="type">Type de mission :</label>
            <select id="type" name="type">
                <option value="Surveillance">Surveillance</option>
                <option value="Assassinat">Assassinat</option>
                <option value="Infiltration">Infiltration</option>
                <option value="Piratage">Piratage</option>
                <option value="Autre">Autre</option>
            </select>
            <input type="text" id="nouveau_type" name="nouveau_type" placeholder="Entrez un nouveau type de mission">
            <button type="button" onclick="ajouterType()">Ajouter type mission</button>
            <br><br>
            <label for="statut">Statut de mission :</label>
            <select id="statut" name="statut">
                <option value="En préparation">En préparation</option>
                <option value="En cours">En cours</option>
                <option value="Terminé">Terminé</option>
                <option value="Echec">Echec</option>

            </select>
            <br><br>
            <br><br>
            <label>Spécialités :</label>
            <br>
            <input type="checkbox" name="specialites[]" value="Infiltration"> Infiltration
            <br>
            <input type="checkbox" name="specialites[]" value="Piratage informatique"> Piratage informatique
            <br>
            <input type="checkbox" name="specialites[]" value="Interrogatoire"> Interrogatoire
            <br>
            <input type="checkbox" name="specialites[]" value="Vol  "> Vol
            <br>
            <input type="checkbox" name="specialites[]" value="Filature"> Filature
            <br><br>
            <label for="date_debut">Date de début :</label>
            <input type="date" id="date_debut" name="date_debut" required>
            <br><br>
            <label for="date_fin">Date de fin :</label>
            <input type="date" id="date_fin" name="date_fin" required>
            <br><br>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <button type="button" onclick="window.location.href='dashboard_admin.php'" class="btn btn-secondary">Retour</button>
        </form>
    </div>


    <script>
        function ajouterType() {
            var nouveauType = document.getElementById("nouveau_type").value;
            if (nouveauType !== "") {
                var select = document.getElementById("type");
                var option = document.createElement("option");
                option.text = nouveauType;
                option.value = nouveauType;
                select.add(option);
                document.getElementById("nouveau_type").value = "";
            }
        }
    </script>

    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5iy6p16f92r&amp;m=1c&amp;c=d8ff70&amp;cr1=ff0000&amp;f=arial&amp;l=49&amp;bv=70&amp;hi=50&amp;he=6&amp;hc=00ff28&amp;rs=100&amp;as=100&amp;cr0=ff8a00&amp;cw=06cc00&amp;cb=000000" async="async"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>