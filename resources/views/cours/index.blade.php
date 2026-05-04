@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">


<h1>Gestion des Cours</h1>


<h2>Ajouter Cours</h2>

<form action="/cours/store" method="POST">
    @csrf

    <input type="text" name="nom" placeholder="Nom cours" class="form-control mb-2">

    <input type="number" name="nombre_heures" placeholder="Nombre heures" class="form-control mb-2">

    
    <select name="filiere_id" class="form-control mb-2">
        <option value="">Filière</option>
        @foreach($filieres as $f)
            <option value="{{ $f->id }}">{{ $f->nom }}</option>
        @endforeach
    </select>

    
    <select name="semestre_id" class="form-control mb-2">
        <option value="">Semestre</option>
        @foreach($semestres as $s)
            <option value="{{ $s->id }}">{{ $s->nom }}</option>
        @endforeach
    </select>

    
    <select name="enseignant_id" class="form-control mb-2">
        <option value="">Enseignant</option>
        @foreach($enseignants as $e)
            <option value="{{ $e->id }}">
                {{ $e->prenom }} {{ $e->nom }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">
        Ajouter
    </button>
</form>

<hr>


<h2>Liste des Cours</h2>

<form method="GET" action="/cours" class="mb-3">

    <select name="filiere_id" class="form-control mb-2">
        <option value="">-- Toutes les filières --</option>
        @foreach($filieres as $f)
            <option value="{{ $f->id }}"
                {{ request('filiere_id') == $f->id ? 'selected' : '' }}>
                {{ $f->nom }}
            </option>
        @endforeach
    </select>

    <select name="semestre_id" class="form-control mb-2">
        <option value="">-- Tous les semestres --</option>
        @foreach($semestres as $s)
            <option value="{{ $s->id }}"
                {{ request('semestre_id') == $s->id ? 'selected' : '' }}>
                {{ $s->nom }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-success">Filtrer</button>
    <a href="/cours" class="btn btn-secondary">Reset</a>

</form>


<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Heures</th>
            <th>Filière</th>
            <th>Semestre</th>
            <th>Enseignant</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @foreach($cours as $c)

        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->nom }}</td>
            <td>{{ $c->nombre_heures }}</td>

            <td>{{ $c->filiere->nom ?? '-' }}</td>
            <td>{{ $c->semestre->nom ?? '-' }}</td>

            <td>
                {{ $c->enseignant->prenom ?? '' }}
                {{ $c->enseignant->nom ?? '' }}
            </td>

            <td>
                <button class="btn btn-warning btn-sm"
                    onclick="openModal(
                        '{{ $c->id }}',
                        '{{ $c->nom }}',
                        '{{ $c->nombre_heures }}',
                        '{{ $c->filiere_id }}',
                        '{{ $c->semestre_id }}',
                        '{{ $c->enseignant_id }}'
                    )">
                    Modifier
                </button>

                <a href="/cours/delete/{{ $c->id }}" class="btn btn-danger btn-sm">
                    Supprimer
                </a>
            </td>
        </tr>

        @endforeach

    </tbody>

</table>


<div class="modal" id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">

    <div style="background:white; padding:20px; width:400px; margin:10% auto;">

        <h3>Modifier Cours</h3>

        <form id="editForm" method="POST">
            @csrf

            <input type="text" name="nom" id="nom" class="form-control mb-2">

            <input type="number" name="nombre_heures" id="nombre_heures" class="form-control mb-2">

            <select name="filiere_id" id="filiere_id" class="form-control mb-2">
                @foreach($filieres as $f)
                    <option value="{{ $f->id }}">{{ $f->nom }}</option>
                @endforeach
            </select>

            <select name="semestre_id" id="semestre_id" class="form-control mb-2">
                @foreach($semestres as $s)
                    <option value="{{ $s->id }}">{{ $s->nom }}</option>
                @endforeach
            </select>

            <select name="enseignant_id" id="enseignant_id" class="form-control mb-2">
                @foreach($enseignants as $e)
                    <option value="{{ $e->id }}">
                        {{ $e->prenom }} {{ $e->nom }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Modifier</button>

            <button type="button" class="btn btn-secondary" onclick="closeModal()">
                Fermer
            </button>

        </form>

    </div>

</div>


<script>

function openModal(id, nom, heures, filiere, semestre, enseignant)
{
    document.getElementById('modal').style.display = 'block';

    document.getElementById('nom').value = nom;
    document.getElementById('nombre_heures').value = heures;
    document.getElementById('filiere_id').value = filiere;
    document.getElementById('semestre_id').value = semestre;
    document.getElementById('enseignant_id').value = enseignant;

    document.getElementById('editForm').action = "/cours/update/" + id;
}

function closeModal()
{
    document.getElementById('modal').style.display = 'none';
}

</script>

@endsection