@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">


<div class="header">
    <h1>Dashboard Administrateur</h1>
</div>

<div class="cards">

    <div class="card">
        <h2>{{ $etudiants }}</h2>
        <p>🎓 Etudiants</p>
    </div>

    <div class="card">
        <h2>{{ $enseignants }}</h2>
        <p>👨‍🏫 Enseignants</p>
    </div>

    <div class="card">
        <h2>{{ $cours }}</h2>
        <p>📚 Cours</p>
    </div>

    <div class="card">
        <h2>{{ $salles }}</h2>
        <p>🚪 Salles</p>
    </div>

    <div class="card">
        <h2>{{ $filieresCount }}</h2>
        <p>🏫 Filières</p>
    </div>

</div>


<h2 class="section-title">Emplois par Filière / Semestre</h2>

<table>
    <thead>
        <tr>
            <th>Filière / Semestre</th>
            <th>État</th>
            <th>Voir</th>
            <th>PDF</th>
        </tr>
    </thead>

    <tbody>
        @foreach($emplois as $emploi)
        <tr>
            <td>{{ $emploi['filiere'] }} - {{ $emploi['semestre'] }}</td>

            <td>
                @if($emploi['existe'])
                    <span class="ok"> Existe</span>
                @else
                    <span class="no"> Aucun</span>
                @endif
            </td>

            <td>
                @if($emploi['existe'])
                    <a class="btn" href="/emplois?filiere_id={{ $emploi['filiere_id'] }}&semestre_id={{ $emploi['semestre_id'] }}">
                        Voir
                    </a>
                @else
                    -
                @endif
            </td>

            <td>
                @if($emploi['existe'])
                    <a class="btn" href="/emplois/pdf?filiere_id={{ $emploi['filiere_id'] }}&semestre_id={{ $emploi['semestre_id'] }}">
                        PDF
                    </a>
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<h2 class="section-title">Derniers Cours Ajoutés</h2>

<table>
    <thead>
        <tr>
            <th>Filière</th>
            <th>Semestre</th>
            <th>Cours</th>
            <th>Enseignant</th>
            <th>Salle</th>
            <th>Jour</th>
            <th>Heure</th>
        </tr>
    </thead>

    <tbody>
        @foreach($dernierEmplois as $e)
        <tr>
            <td>{{ $e->cours->filiere->nom ?? '' }}</td>
            <td>{{ $e->cours->semestre->nom ?? '' }}</td>
            <td>{{ $e->cours->nom ?? '' }}</td>
            <td>
                {{ $e->cours->enseignant->prenom ?? '' }}
                {{ $e->cours->enseignant->nom ?? '' }}
            </td>
            <td>{{ $e->salle->nom ?? '' }}</td>
            <td>{{ $e->jour }}</td>
            <td>{{ substr($e->heure_debut,0,5) }} - {{ substr($e->heure_fin,0,5) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection