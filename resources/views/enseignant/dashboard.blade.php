<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>


.hero-container{
    display:flex;
    min-height:80vh;
}





   
h5{
    color: #C59594;
    background: black;
   
}
footer{
    background: black;
    color: white;

}



/* Tablets */
@media (max-width: 992px) {

    .header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }

    .menu {
        flex-wrap: wrap;
        justify-content: center;
    }

    .cards {
        flex-direction: column;
    }

    .content {
        padding: 20px;
    }
}

/* Phones */
@media (max-width: 768px) {

    .cards {
        flex-direction: column;
    }

    .card {
        width: 100%;
    }

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .header {
        padding: 10px;
    }

    .menu a {
        padding: 8px 10px;
        font-size: 14px;
    }

    .logout-btn {
        padding: 8px 10px;
        font-size: 14px;
    }
}

/* Very small phones */
@media (max-width: 480px) {

    h2 {
        font-size: 18px;
    }

    .card h3 {
        font-size: 24px;
    }

    .card p {
        font-size: 14px;
    }
}
html, body {
    height: 100%;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}


footer {
    margin-top: auto;
}

































        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial;
            color:#2c3e50;

            /* ===== YOUR CUSTOM GRADIENT ===== */
            background: linear-gradient(135deg, #C7DBF7, #BFC7DE, #75708C, #C59594);
            min-height:100vh;
        }

        /* ================= HEADER ================= */

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
            color:#75708C;
            padding:10px 18px;
            border-radius:6px;
            background:rgba(255,255,255,0.3);
            cursor:pointer;
        }

        .logout-btn:hover{
            background:rgba(255,255,255,0.5);
        }

        /* ================= CONTENT ================= */

        .content{
            padding:40px;
        }

        h2{
            margin-bottom:20px;
        }

        /* ================= CARDS ================= */

        .cards{
    display:flex;
    gap:20px;
    margin-bottom:30px;
    width:100%;
}

       .card{
    background:white;
    padding:25px;
    border-radius:12px;
    flex:1; /* IMPORTANT */
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
        .card h3{
            font-size:32px;
            color:#3498db;
        }

        .card p{
            color:#777;
        }

        /* ================= TABLE ================= */

        .table-box{
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#75708C;
            color:white;
            padding:12px;
        }

        td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #ddd;
        }

        tr:hover{
            background:#f9f9f9;
        }

    </style>
</head>

<body>

<!-- ================= HEADER ================= -->

<div class="header">

    <div class="logo">
        Espace Enseignant
    </div>

    <div class="menu">

        <a href="/enseignant/dashboard">
            Dashboard
        </a>

        <a href="/contact">
            Contact
        </a>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn">
                Logout
            </button>
        </form>

    </div>

</div>

<!-- ================= CONTENT ================= -->

<div class="content">


    <!-- CARDS -->
    <div class="cards">

        <div class="card">
            <h3>{{ $totalCours }}</h3>
            <p>Total Cours</p>
        </div>

        <div class="card">
            <h3>{{ $totalHeures }}</h3>
            <p>Total Heures</p>
        </div>

    </div>

    <!-- TABLE -->
   <div class="table-box">

   

    <table>

        <tr>
            <th>Jour</th>
            <th>Heure</th>
            <th>Cours</th>
            <th>Filière</th>
            <th>Semestre</th>
            <th>Salle</th>
        </tr>

        @foreach($emplois as $e)

        <tr>
            <td>{{ $e->jour }}</td>

            <td>
                {{ substr($e->heure_debut,0,5) }} - {{ substr($e->heure_fin,0,5) }}
            </td>

            <td>{{ $e->cours->nom ?? '' }}</td>

            <td>{{ $e->cours->filiere->nom ?? '' }}</td>

            <td>{{ $e->cours->semestre->nom ?? '' }}</td>

            <td>{{ $e->salle->nom ?? '' }}</td>
        </tr>

        @endforeach

    </table>

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