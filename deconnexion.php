

<?php
session_start();
session_destroy();
// Supprimer les cookies de session si utilisés
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}
header("Location: home.php");
exit;
?>