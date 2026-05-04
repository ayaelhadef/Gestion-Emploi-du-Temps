<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>

    <style>
    h5{
    color: #C59594;
    background: black;
   
}
footer{
    background: black;
    color: white;

}

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial;
            color:#2c3e50;

            background: linear-gradient(135deg, #C7DBF7, #BFC7DE, #75708C, #C59594);
            min-height:100vh;
        }


        .header{
            width:100%;
            background:rgba(255,255,255,0.25);
            backdrop-filter: blur(10px);
            padding:18px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            color:#1f2d3d;
            font-size:24px;
            font-weight:bold;
        }

        .menu{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .menu a{
            color:#1f2d3d;
            text-decoration:none;
            padding:10px 18px;
            border-radius:6px;
            transition:0.3s;
        }

        .menu a:hover{
            background:rgba(255,255,255,0.4);
        }

        .logout-btn{
            border:none;
            color:#1f2d3d;
            padding:10px 18px;
            border-radius:6px;
            background:#75708C;
            cursor:pointer;
        }

        .logout-btn:hover{
            background:rgba(255,255,255,0.5);
        }


        .content{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:60px;
            padding:70px 20px;
            flex-wrap:wrap;
        }


        .text-box{
            max-width:420px;
            color:black;
        }

        .text-box h1{
            font-size:40px;
            margin-bottom:15px;
        }

        .text-box p{
            font-size:17px;
            line-height:1.6;
            opacity:0.95;
        }


        .contact-box{
            width:100%;
            max-width:450px;
            background:rgba(255,255,255,0.92);
            padding:30px;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }

        .contact-box h2{
            margin-bottom:20px;
            text-align:center;
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:6px;
            font-weight:bold;
        }

        input, textarea{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:8px;
        }

        textarea{
            height:120px;
            resize:none;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            background:#75708C;
            color:white;
            border-radius:8px;
            cursor:pointer;
            font-size:16px;
            transition:0.3s;
        }

        button:hover{
            background:#5f5a73;
        }

    </style>
</head>

<body>

{{-- HEADER --}}

<div class="header">

    
    <div class="logo">

        @if(auth()->user()->role == 'etudiant')

            Espace Étudiant

        @elseif(auth()->user()->role == 'enseignant')

            Espace Enseignant

        @endif

    </div>

    {{-- MENU --}}
    <div class="menu">

        {{-- MENU  pour l'étudiant --}}
        @if(auth()->user()->role == 'etudiant')

            <a href="/etudiant/dashboard">
                Dashboard
            </a>

            <a href="/etudiant/planning/pdf">
                Emploi
            </a>

            <a href="/contact">
                Contact
            </a>

        @endif


        {{-- menu pour l'enseignant --}}
        @if(auth()->user()->role == 'enseignant')

            <a href="/enseignant/dashboard">
                Dashboard
            </a>

            <a href="/contact">
                Contact
            </a>

        @endif


        {{-- LOGOUT --}}
        <form method="POST" action="/logout">
            @csrf

            <button class="logout-btn">
                Logout
            </button>
        </form>

    </div>

</div>

{{-- Contenu --}}

<div class="content">

    <div class="text-box">

        <h1>Contactez-nous</h1>

        <p>
            Vous pouvez nous contacter pour toute question
            concernant les cours, emplois du temps
            ou informations pédagogiques.
        </p>

    </div>

    <div class="contact-box">

        <h2>Formulaire de contact</h2>

        <form method="POST" action="/contact">

            @csrf

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Votre email"
                >

            </div>

            <div class="form-group">

                <label>Sujet</label>

                <input
                    type="text"
                    name="sujet"
                    placeholder="Sujet"
                >

            </div>

            <div class="form-group">

                <label>Message</label>

                <textarea
                    name="message"
                    placeholder="Votre message"
                ></textarea>

            </div>

            <button type="submit">
                Envoyer
            </button>

        </form>

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