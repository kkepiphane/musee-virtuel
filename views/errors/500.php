<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur serveur - Musée Virtuel</title>
    <style>
        :root {
            --primary: #3a506b;
            --secondary: #5bc0be;
            --dark: #1c2541;
            --light: #f8f9fa;
            --error: #e63946;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light);
            color: var(--dark);
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            line-height: 1.6;
        }
        
        .error-container {
            max-width: 700px;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: shake 0.5s ease-out;
        }
        
        h1 {
            font-size: 5rem;
            color: var(--error);
            margin-bottom: 20px;
        }
        
        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--primary);
        }
        
        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 10px;
        }
        
        .btn:hover {
            background: var(--dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .technical-details {
            margin-top: 30px;
            text-align: left;
            background: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 0.9rem;
            display: none;
            max-height: 200px;
            overflow-y: auto;
        }
        
        .toggle-details {
            background: none;
            border: none;
            color: var(--primary);
            text-decoration: underline;
            cursor: pointer;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .contact-link {
            color: var(--secondary);
            font-weight: 600;
        }
        
        .loader {
            display: none;
            margin: 20px auto;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--secondary);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>500</h1>
        <h2>Erreur interne du serveur</h2>
        <p>Désolé, quelque chose s'est mal passé de notre côté. Notre équipe a été notifiée et travaille à résoudre le problème.</p>
        
        <a href="<?= url() ?>" class="btn">Retour à l'accueil</a>
        <a href="javascript:window.location.reload()" class="btn">Réessayer</a>
        
        <button class="toggle-details" onclick="toggleDetails()">Afficher les détails techniques</button>
        
        <div class="technical-details" id="techDetails">
            <p><strong>Erreur :</strong> <span id="errorMessage"></span></p>
            <p><strong>Fichier :</strong> <span id="errorFile"></span></p>
            <p><strong>Ligne :</strong> <span id="errorLine"></span></p>
            <div id="errorTrace"></div>
        </div>
        
        <div class="loader" id="loader"></div>
        
        <p style="margin-top: 30px;">Si le problème persiste, contactez-nous à <a href="mailto:support@museevirtuel.com" class="contact-link">support@museevirtuel.com</a></p>
    </div>

    <script>
        // Afficher les détails d'erreur si en mode debug
        <?php if (APP_DEBUG && isset($e)): ?>
            document.getElementById('errorMessage').textContent = "<?= addslashes($e->getMessage()) ?>";
            document.getElementById('errorFile').textContent = "<?= addslashes($e->getFile()) ?>";
            document.getElementById('errorLine').textContent = "<?= $e->getLine() ?>";
            document.getElementById('errorTrace').innerHTML = "<pre><?= addslashes($e->getTraceAsString()) ?></pre>";
        <?php endif; ?>
        
        function toggleDetails() {
            const details = document.getElementById('techDetails');
            details.style.display = details.style.display === 'block' ? 'none' : 'block';
        }
        
        // Auto-réessai après 10 secondes
        setTimeout(() => {
            document.getElementById('loader').style.display = 'block';
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        }, 10000);
        
        // Rapport d'erreur automatique
        window.addEventListener('load', () => {
            if(navigator.onLine) {
                const errorData = {
                    message: document.getElementById('errorMessage').textContent,
                    file: document.getElementById('errorFile').textContent,
                    line: document.getElementById('errorLine').textContent,
                    url: window.location.href,
                    userAgent: navigator.userAgent
                };
                
                // Envoyer le rapport au serveur (simplifié)
                fetch('<?= url("api/error-report") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(errorData)
                }).catch(() => {});
            }
        });
    </script>
</body>
</html>