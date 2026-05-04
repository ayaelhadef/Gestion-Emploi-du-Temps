<!DOCTYPE html>
<html>
<head>
    <title>Mon Emploi du Temps</title>

    <style>
        body{
            font-family: Arial;
        }

        h2{
            text-align:center;
        }

        .info{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse: collapse;
            text-align:center;
            font-size:12px;
        }

        th, td{
            border:1px solid black;
            padding:8px;
        }

        th{
            background:#2c3e50;
            color:white;
        }

        .cours{
            background:#e8f4ff;
            padding:5px;
            margin:2px;
            border-radius:4px;
        }
    </style>
</head>

<body>

<h2> Mon Emploi du Temps</h2>

<div class="info">
    Filière :
    <b>{{ $user->filiere->nom ?? '' }}</b>
    |
    Semestre :
    <b>{{ $user->semestre->nom ?? '' }}</b>
</div>

@php
$jours = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi'];

$heures = [
    '08:00' => '10:15',
    '10:30' => '12:15',
    '14:30' => '16:15',
    '16:30' => '18:15'
];
@endphp

<table>

<tr>
    <th>Jour / Heure</th>

    @foreach($heures as $debut => $fin)
        <th>{{ $debut }} - {{ $fin }}</th>
    @endforeach
</tr>

@foreach($jours as $jour)

<tr>
    <th>{{ $jour }}</th>

    @foreach($heures as $debut => $fin)

    <td>

        @foreach($emplois as $e)

            @php
                $hd = substr($e->heure_debut,0,5);
            @endphp

            @if($e->jour == $jour && $hd >= $debut && $hd < $fin)

                <div class="cours">

                    <b>{{ $e->cours->nom }}</b><br>

                    {{ $e->cours->enseignant->prenom ?? '' }}
                    {{ $e->cours->enseignant->nom ?? '' }}<br>

                    Salle : {{ $e->salle->nom ?? '' }}

                </div>

            @endif

        @endforeach

    </td>

    @endforeach

</tr>

@endforeach

</table>

</body>
</html>