<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

<div class="hero-container">

    <!-- position de login -->
    <div class="login-side">

        <div class="login-box">

            <h2>Connexion</h2>

           <form method="POST" action="/login">

    @csrf

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    <input
        type="email"
        name="email"
        placeholder="Email"
        required
    >

    <input
        type="date"
        name="password"
        required
    >

    <button type="submit">
        Se connecter
    </button>

</form>

        </div>

    </div>

   <div class="welcome-side">

    <div class="welcome-content">

        <h1>
            <strong>Bienvenue à</strong><br>
            <em>la Planification sans friction</em>
        </h1>

        <p class="welcome-text">
            Optimisez la gestion des emplois du temps de votre établissement grâce à une 
            plateforme permettant l’organisation efficace des salles, des 
            enseignants et des créneaux horaires.
        </p>

    </div>

</div>
  

</div>
 <footer>
    <div class="container p-4">
        <div class="row">

            <div class="col-md-6">
                <h5 class="text-uppercase">Contact</h5>
                <p class="mb-1">📞 Téléphone : +212 6 00 00 00 00</p>
                <p class="mb-1">📍 Adresse : ENSIASD, Taroudant</p>
                <p class="mb-1">✉ Email : contact@ensiasd.ma</p>
                <p class="mb-1">@ENSIASD</p>
            </div>

            <div class="col-md-6 text-md-end text-center">
                <h5 class="text-uppercase">Suivez-nous</h5>

                <a href="#" class="text-white me-3 fs-4">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="#" class="text-white me-3 fs-4">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="#" class="text-white me-3 fs-4">
                    <i class="bi bi-twitter-x"></i>
                </a>

                <a href="#" class="text-white fs-4">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="text-center bg-secondary p-2">
        © {{ date('Y') }} Gestion Emploi du Temps | ENSIASD
    </div>
</footer>

</body>
</html>