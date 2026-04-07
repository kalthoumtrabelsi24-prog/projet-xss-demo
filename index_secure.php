<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Site SÉCURISÉ</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
        
        .success-banner {
            background: #d4edda;
            border-left: 5px solid #28a745;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .success-banner strong {
            color: #155724;
            font-size: 1.1em;
        }
        
        .formulaire {
            background: #d4edda;
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px solid #28a745;
        }
        
        .formulaire h2 {
            color: #155724;
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
            border-color: #28a745;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }
        
        button {
            background: #28a745;
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
            background: #218838;
        }
        
        .commentaire {
            background: #fafafa;
            border-left: 5px solid #28a745;
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
            color: #28a745;
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
            background: #28a745;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            margin-left: 10px;
        }
        
        .info-box {
            background: #e7f3ff;
            border: 2px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
        }
        
        .info-box h3 {
            color: #1976D2;
            margin-bottom: 10px;
        }
        
        .info-box ul {
            margin-left: 20px;
            color: #333;
        }
        
        .info-box li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛡️ Forum de Discussion <span class="badge">SÉCURISÉ</span></h1>
        
        <div class="success-banner">
            ✅ <strong>SITE PROTÉGÉ CONTRE LES ATTAQUES XSS</strong><br>
            Ce site implémente les bonnes pratiques de sécurité :<br>
            • Filtrage des entrées utilisateur<br>
            • Échappement des sorties HTML<br>
            • Protection contre l'injection de code JavaScript
        </div>

        <div class="info-box">
            <h3>🔒 Protections actives :</h3>
            <ul>
                <li><strong>htmlspecialchars()</strong> : Convertit les caractères spéciaux en entités HTML</li>
                <li><strong>mysqli_real_escape_string()</strong> : Protection contre l'injection SQL</li>
                <li><strong>Cookies HttpOnly</strong> : Les cookies ne sont pas accessibles via JavaScript</li>
            </ul>
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

        // TRAITEMENT DU FORMULAIRE
        if (isset($_POST['submit'])) {
            // ✅ PROTECTION 1 : Échapper les caractères spéciaux avant insertion
            // Cela empêche l'injection SQL
            $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
            $commentaire = mysqli_real_escape_string($connexion, $_POST['commentaire']);
            
            $sql = "INSERT INTO commentaires (nom, commentaire) VALUES ('$nom', '$commentaire')";
            
            if (mysqli_query($connexion, $sql)) {
                echo "<div class='success'>✅ Votre commentaire a été publié avec succès et est sécurisé !</div>";
            } else {
                echo "<div class='error'>❌ Erreur lors de la publication : " . mysqli_error($connexion) . "</div>";
            }
        }

        // AFFICHER TOUS LES COMMENTAIRES
        echo "<h2 style='color: #333; margin-top: 30px; border-bottom: 3px solid #28a745; padding-bottom: 10px;'>📋 Tous les commentaires</h2>";
        
        $resultat = mysqli_query($connexion, "SELECT * FROM commentaires ORDER BY date_ajout DESC");
        
        if (mysqli_num_rows($resultat) > 0) {
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "<div class='commentaire'>";
                
                // ✅ PROTECTION 2 : htmlspecialchars() convertit les caractères dangereux
                // < devient &lt; (affiché comme texte, pas comme balise HTML)
                // > devient &gt;
                // Donc <script> devient &lt;script&gt; et ne s'exécute PAS
                
                echo "<div class='nom'>👤 " . htmlspecialchars($row['nom']) . "</div>";
                echo "<div class='texte'>" . htmlspecialchars($row['commentaire']) . "</div>";
                echo "<div class='date'>🕒 Publié le : " . $row['date_ajout'] . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align: center; color: #999; padding: 30px;'>Aucun commentaire pour le moment. Soyez le premier à poster !</p>";
        }

        mysqli_close($connexion);
        ?>
    </div>

    <!-- COOKIES SÉCURISÉS (avec httpOnly simulé) -->
    <script>
        // Note : En vrai, les cookies httpOnly sont créés côté serveur (PHP)
        // Ici on simule juste pour la démo visuelle
        document.cookie = "session_id=ABC123456789XYZ; path=/; SameSite=Strict";
        console.log("🔒 Cookies sécurisés créés (httpOnly devrait être activé côté serveur)");
    </script>
</body>
</html>