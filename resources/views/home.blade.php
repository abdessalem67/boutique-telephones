<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Boutique</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #eef2f3, #8e9eab);
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2d3748;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 2rem;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 14px 28px;
            background-color: #2b6cb0;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #2c5282;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenue dans la boutique TechStore</h1>
</header>

<div class="container">
    <h2>Page d’accueil</h2>
    <p>Accédez aux différentes sections :</p>

    <a href="{{ route('produits.index') }}" class="btn">Voir les Produits</a>
    <a href="{{ route('categories.index') }}" class="btn">Voir les Catégories</a>
    <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>

    @auth
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn" style="background-color: #e53e3e;">Se déconnecter</button>
    </form>
    @endauth
</div>


<footer>
    &copy; {{ date('Y') }} TechStore. Tous droits réservés.
</footer>

</body>
</html>
