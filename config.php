<?php
// Fichier : config.php
// Ce fichier permet de connecter notre site à la base de données MySQL

// PARAMÈTRES DE CONNEXION
$serveur = "127.0.0.1";       // Adresse du serveur (127.0.0.1 = localhost)
$utilisateur = "root";         // Nom d'utilisateur MySQL
$motdepasse = "";              // Mot de passe (vide par défaut sur XAMPP)
$base = "test_xss";            // Nom de la base de données qu'on a créée
$port = 3307;                  // Port MySQL (3307 dans ton cas)

// CRÉER LA CONNEXION
$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $base, $port);

// VÉRIFIER SI LA CONNEXION FONCTIONNE
if (!$connexion) {
    // Si ça ne marche pas, afficher l'erreur et arrêter
    die("❌ Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Si on arrive ici, la connexion est OK !
// echo "✅ Connexion réussie !"; // Tu peux décommenter pour tester
?>