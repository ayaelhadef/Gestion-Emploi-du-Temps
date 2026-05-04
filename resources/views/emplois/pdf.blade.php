<!DOCTYPE html>
<html>
<head>
    <title>Emploi du Temps PDF</title>

    <style>
        body{
            font-family: Arial;
        }

        h2{
            text-align:center;
            margin-bottom:10px;
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
            vertical-align: top;
        }

        th{
            background:#2c3e50;
            color:white;
        }

        .cours{
            background:#e8f4ff;
            margin:2px;
            padding:5px;
            border-radius:4px;
        }
    </style>
</head>

<body>

<h2>Emploi du Temps</h2>

<div class="info">
    Filière :
    <b>
        {{ $filieres->find(request('filiere_id'))->nom ?? 'Toutes' }}
    </b>
    |
    Semestre :
    <b>
        {{ $semestres->find(request('semestre_id'))->nom ?? 'Tous' }}
    </b>
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
                $heureDebut = substr($e->heure_debut, 0, 5);
                $heureFin   = substr($e->heure_fin, 0, 5);
            @endphp

            @if(
                $e->jour == $jour
                &&
                $heureDebut >= $debut
                &&
                $heureDebut < $fin
            )

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