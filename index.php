<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Site VULNÉRABLE XSS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 30px;
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2.5em;
        }
        
        .warning {
            background: #ffebee;
            border-left: 5px solid #f44336;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .warning strong {
            color: #c62828;
            font-size: 1.1em;
        }
        
        .formulaire {
            background: #e3f2fd;
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px solid #2196F3;
        }
        
        .formulaire h2 {
            color: #1976D2;
            margin-bottom: 15px;
        }
        
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus, textarea:focus {
            outline: none;
            border-color: #2196F3;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }
        
        button {
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }
        
        button:hover {
            background: #45a049;
        }
        
        .commentaire {
            background: #fafafa;
            border-left: 5px solid #4CAF50;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        
        .commentaire:hover {
            transform: translateX(5px);
        }
        
        .commentaire .nom {
            font-weight: bold;
            color: #4CAF50;
            font-size: 1.2em;
            margin-bottom: 8px;
        }
        
        .commentaire .texte {
            color: #333;
            line-height: 1.6;
            margin: 10px 0;
        }
        
        .commentaire .date {
            color: #999;
            font-size: 0.9em;
            margin-top: 10px;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            border-left: 5px solid #28a745;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            border-left: 5px solid #dc3545;
        }
        
        .badge {
            display: inline-block;
            background: #f44336;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💬 Forum de Discussion <span class="badge">VULNÉRABLE</span></h1>
        
        <div class="warning">
            ⚠️ <strong>ATTENTION - SITE DE DÉMONSTRATION PÉDAGOGIQUE</strong><br>
            Ce site est <strong>VOLONTAIREMENT VULNÉRABLE</strong> aux attaques XSS (Cross-Site Scripting).<br>
            Il ne filtre PAS les entrées utilisateur. Ne JAMAIS créer un vrai site comme celui-ci !<br>
            Environnement isolé à des fins éducatives uniquement.
        </div>

        <!-- FORMULAIRE POUR POSTER UN COMMENTAIRE -->
        <div class="formulaire">
            <h2>✍️ Poster un nouveau commentaire</h2>
            <form method="POST" action="">
                <input type="text" name="nom" placeholder="Votre nom" required>
                <textarea name="commentaire" placeholder="Votre commentaire..." rows="4" required></textarea>
                <button type="submit" name="submit">📤 Publier le commentaire</button>
            </form>
        </div>

        <?php
        // INCLURE LA CONNEXION À LA BASE DE DONNÉES
        include 'config.php';

        // TRAITEMENT DU FORMULAIRE QUAND ON CLIQUE SUR "PUBLIER"
        if (isset($_POST['submit'])) {
            // Récupérer les données envoyées par le formulaire
            $nom = $_POST['nom'];
            $commentaire = $_POST['commentaire'];
            
            // ⚠️⚠️⚠️ VULNÉRABILITÉ XSS ⚠️⚠️⚠️
            // On insère les données DIRECTEMENT sans aucun filtrage
            // Un attaquant peut injecter du code JavaScript malveillant !
            $nom = mysqli_real_escape_string($connexion, $nom);
             $commentaire = mysqli_real_escape_string($connexion, $commentaire);
            $sql = "INSERT INTO commentaires (nom, commentaire) VALUES ('$nom', '$commentaire')";
            
            if (mysqli_query($connexion, $sql)) {
                echo "<div class='success'>✅ Votre commentaire a été publié avec succès !</div>";
            } else {
                echo "<div class='error'>❌ Erreur lors de la publication : " . mysqli_error($connexion) . "</div>";
            }
        }

        // AFFICHER TOUS LES COMMENTAIRES
        echo "<h2 style='color: #333; margin-top: 30px; border-bottom: 3px solid #4CAF50; padding-bottom: 10px;'>📋 Tous les commentaires</h2>";
        
        // Requête pour récupérer tous les commentaires (du plus récent au plus ancien)
        $resultat = mysqli_query($connexion, "SELECT * FROM commentaires ORDER BY date_ajout DESC");
        
        // Vérifier s'il y a des commentaires
        if (mysqli_num_rows($resultat) > 0) {
            // Parcourir chaque commentaire
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "<div class='commentaire'>";
                
                // ⚠️⚠️⚠️ VULNÉRABILITÉ XSS ⚠️⚠️⚠️
                // On affiche le nom et le commentaire DIRECTEMENT
                // Si quelqu'un a mis du code JavaScript, il va s'exécuter !
                echo "<div class='nom'>👤 " . $row['nom'] . "</div>";
                echo "<div class='texte'>" . $row['commentaire'] . "</div>";
                
                echo "<div class='date'>🕒 Publié le : " . $row['date_ajout'] . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align: center; color: #999; padding: 30px;'>Aucun commentaire pour le moment. Soyez le premier à poster !</p>";
        }

        // Fermer la connexion à la base de données
        mysqli_close($connexion);
        ?>
    </div>

    <!-- SIMULATION DE COOKIES (pour la démonstration du vol) -->
    <script>
        // On crée des cookies "sensibles" pour simuler une vraie session utilisateur
        document.cookie = "session_id=ABC123456789XYZ; path=/";
        document.cookie = "user_role=admin; path=/";
        document.cookie = "username=Marie_Dupont; path=/";
        
        console.log("🍪 Cookies créés :", document.cookie);
    </script>
</body>
</html>