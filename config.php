
<?php
// Informations de connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kgbnew";


// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8;port=3306", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "La connexion à la base de données a échoué: " . $e->getMessage();
}
