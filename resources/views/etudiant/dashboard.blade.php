<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Étudiant</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/headfoot.css') }}">

    <style>
h5{
    color: #C59594;
    background: black;
   
}
footer{
    background: black;
    color: white;

}



@media (max-width: 992px) {

    .top-section {
        flex-direction: column;
    }

    .cards {
        flex-direction: row;
        flex-wrap: wrap;
    }

    .card {
        min-width: 45%;
    }
}

@media (max-width: 768px) {

    .header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }

    .menu {
        flex-wrap: wrap;
        justify-content: center;
    }

    .content {
        padding: 20px;
    }

    .cards {
        flex-direction: column;
    }

    .card {
        width: 100%;
    }

    .chart-box {
        width: 100%;
    }

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}

@media (max-width: 480px) {

    h3 {
        font-size: 18px;
    }

    .card h3 {
        font-size: 26px;
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

.content {
    flex: 1;
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
            color:#75708C;
            padding:10px 18px;
            border-radius:6px;
            background:rgba(255,255,255,0.3);
            cursor:pointer;
        }

        .content{
            padding:40px;
        }

        h2{
            margin-bottom:20px;
        }


        .top-section{
            display:flex;
            gap:20px;
            align-items:stretch;
        }

        .chart-box{
            flex:3;
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .cards{
            flex:1;
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:12px;
            text-align:center;
            box-shadow:0 2px 12px rgba(0,0,0,0.08);
            flex:1;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .card h3{
            font-size:36px;
            color:#3498db;
            margin-bottom:10px;
        }

        .card p{
            color:#777;
            font-size:16px;
        }



        .table-box{
            margin-top:30px;
            background:white;
            padding:20px;
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
            background:#f2f2f2;
        }

    </style>
</head>

<body>

<!-- HEADER -->
<div class="header">

    <div class="logo">Espace Étudiant</div>

    <div class="menu">
        <a href="/etudiant/dashboard">Dashboard</a>
        <a href="/etudiant/planning/pdf">Emploi</a>
        <a href="/contact">Contact</a>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

</div>

<div class="content">


    <div class="top-section">

        <div class="chart-box">
            <h3> Cours par jour</h3>
            <canvas id="chart" height="120"></canvas>
        </div>

        <div class="cards">

            <div class="card">
                <h3>{{ $totalCours }}</h3>
                <p>Total cours</p>
            </div>

            <div class="card">
                <h3>{{ $totalHeures }}</h3>
                <p>Total heures</p>
            </div>

        </div>

    </div>

    <div class="table-box">


        <table>
            <tr>
                <th>Cours</th>
                <th>Heures</th>
            </tr>

            @foreach($cours as $c)
            <tr>
                <td>{{ $c->nom }}</td>
                <td>{{ $c->nombre_heures }}h</td>
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
<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($jours) !!},
        datasets: [
            @foreach($chartData as $c)
            {
                label: "{{ $c['label'] }}",
                data: {!! json_encode(
                    array_map(function($v) {
                        preg_match('/(\d+)h(\d+)?/', $v, $m);
                        $h = $m[1] ?? 0;
                        $min = $m[2] ?? 0;
                        return $h + ($min/60);
                    }, $c['data'])
                ) !!},
                borderWidth: 1
            },
            @endforeach
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>