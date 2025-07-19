<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - Musée Virtuel</title>
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
            background-image: url('<?= asset('images/art-pattern.png') ?>');
            background-size: cover;
            background-blend-mode: overlay;
            background-color: rgba(248, 249, 250, 0.9);
        }
        
        .error-container {
            max-width: 600px;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-out;
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
            line-height: 1.6;
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
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background: var(--dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            background: var(--secondary);
        }
        
        .art-preview {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .art-preview img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            transition: transform 0.3s;
            cursor: pointer;
        }
        
        .art-preview img:hover {
            transform: scale(1.1);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .search-box {
            margin: 25px 0;
            position: relative;
            width: 100%;
        }
        
        .search-box input {
            width: 100%;
            padding: 12px 20px;
            border: 2px solid #ddd;
            border-radius: 50px;
            font-size: 1rem;
            outline: none;
            transition: border 0.3s;
        }
        
        .search-box input:focus {
            border-color: var(--secondary);
        }
        
        .search-box button {
            position: absolute;
            right: 5px;
            top: 5px;
            background: var(--secondary);
            border: none;
            border-radius: 50px;
            padding: 7px 15px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <h2>Oups ! Page non trouvée</h2>
        <p>La page que vous cherchez semble avoir été déplacée, supprimée ou n'existe pas.</p>
        
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Que cherchez-vous ?">
            <button onclick="searchSite()">Rechercher</button>
        </div>
        
        <a href="<?= url() ?>" class="btn">Retour à l'accueil</a>
        <a href="<?= url('galerie') ?>" class="btn btn-secondary">Explorer la galerie</a>
        
        <div class="art-preview" id="artPreview">
            <!-- Contenu généré par JavaScript -->
        </div>
    </div>

    <script>
        // Afficher des œuvres aléatoires
        const artworks = [
            {img: 'art1.jpg', url: 'galerie/1'},
            {img: 'art2.jpg', url: 'galerie/2'},
            {img: 'art3.jpg', url: 'galerie/3'},
            {img: 'art4.jpg', url: 'galerie/4'},
            {img: 'art5.jpg', url: 'galerie/5'},
            {img: 'art6.jpg', url: 'galerie/6'}
        ];
        
        const artPreview = document.getElementById('artPreview');
        
        // Mélanger et prendre 4 œuvres aléatoires
        const shuffled = artworks.sort(() => 0.5 - Math.random());
        const selected = shuffled.slice(0, 4);
        
        // Afficher les œuvres
        selected.forEach(art => {
            const img = document.createElement('img');
            img.src = `<?= asset('images/oeuvres/') ?>${art.img}`;
            img.alt = "Œuvre d'art";
            img.onclick = () => window.location.href = `<?= url() ?>${art.url}`;
            artPreview.appendChild(img);
        });
        
        // Fonction de recherche
        function searchSite() {
            const query = document.getElementById('searchInput').value.trim();
            if(query) {
                window.location.href = `<?= url('recherche') ?>?q=${encodeURIComponent(query)}`;
            }
        }
        
        // Permettre la recherche avec Entrée
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if(e.key === 'Enter') {
                searchSite();
            }
        });
    </script>
</body>
</html>