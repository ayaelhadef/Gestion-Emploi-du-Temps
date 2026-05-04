@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">



<h1>Gestion Emploi du Temps</h1>


@if(session('error'))
    <p style="color:red">
        {{ session('error') }}
    </p>
@endif

@if(session('success'))
    <p style="color:green">
        {{ session('success') }}
    </p>
@endif


<h2>Choisir Filière et Semestre</h2>

<form method="GET" action="/emplois">

    <select name="filiere_id">

        <option value="">Filière</option>

        @foreach($filieres as $f)

            <option value="{{ $f->id }}">
                {{ $f->nom }}
            </option>

        @endforeach

    </select>

    <select name="semestre_id">

        <option value="">Semestre</option>

        @foreach($semestres as $s)

            <option value="{{ $s->id }}">
                {{ $s->nom }}
            </option>

        @endforeach

    </select>

    <button type="submit">
        Afficher Cours
    </button>

</form>

<hr>


<h2>Ajouter Emploi</h2>

<form method="POST" action="/emplois/store">

    @csrf

    <!-- cours -->
    <select name="cours_id">

        @foreach($cours as $c)

            <option value="{{ $c->id }}">

                {{ $c->nom }}
                -
                {{ $c->enseignant->prenom ?? '' }}
                {{ $c->enseignant->nom ?? '' }}

                ({{ $c->nombre_heures }}h)

            </option>

        @endforeach

    </select>

    <br><br>

    <!-- salle -->
    <select name="salle_id">

        @foreach($salles as $s)

            <option value="{{ $s->id }}">
                {{ $s->nom }}
            </option>

        @endforeach

    </select>

    <br><br>

    <select name="jour">

        <option>Lundi</option>
        <option>Mardi</option>
        <option>Mercredi</option>
        <option>Jeudi</option>
        <option>Vendredi</option>

    </select>

    <br><br>

    <input type="time" name="heure_debut">

    <input type="time" name="heure_fin">

    <br><br>

    <button type="submit">
        Ajouter Emploi
    </button>

</form>

<hr>

 <h2>Afficher Emploi par Filière et Semestre</h2>



<form method="GET" action="/emplois" class="filter-form">

    <div class="form-row">

        <select name="filiere_id" class="input-style">
            <option value="">Nom Filière</option>

            @foreach($filieres as $f)
                <option value="{{ $f->id }}">
                    {{ $f->nom }}
                </option>
            @endforeach
        </select>

        <select name="semestre_id" class="input-style">
            <option value="">Semestre</option>

            @foreach($semestres as $s)
                <option value="{{ $s->id }}">
                    {{ $s->nom }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn-primary">
            Afficher
        </button>

    </div>

</form>

<br>



<a href="/emplois/pdf?
filiere_id={{ request('filiere_id') }}
&semestre_id={{ request('semestre_id') }}" >

    Export PDF

</a>

<hr>

<h2>Liste des Emplois</h2>

<table border="1" cellpadding="10">

<tr>

    <th>Jour</th>
    <th>Heure</th>
    <th>Cours</th>
    <th>Enseignant</th>
    <th>Filière</th>
    <th>Semestre</th>
    <th>Salle</th>
    <th>Action</th>

</tr>

@foreach($emplois as $e)

<tr>

    <td>{{ $e->jour }}</td>

    <td>
        {{ $e->heure_debut }}
        -
        {{ $e->heure_fin }}
    </td>

    <td>{{ $e->cours->nom }}</td>

    <td>
        {{ $e->cours->enseignant->prenom ?? '' }}
        {{ $e->cours->enseignant->nom ?? '' }}
    </td>

    <td>
        {{ $e->cours->filiere->nom ?? '' }}
    </td>

    <td>
        {{ $e->cours->semestre->nom ?? '' }}
    </td>

    <td>
        {{ $e->salle->nom ?? '' }}
    </td>
    <td>
    <button onclick="openModal(
        '{{ $e->id }}',
        '{{ $e->jour }}',
        '{{ $e->heure_debut }}',
        '{{ $e->heure_fin }}',
        '{{ $e->salle_id }}',
        '{{ $e->cours->enseignant_id ?? '' }}'
    )">
        Modifier
    </button>
</td>

</tr>

@endforeach

</table>

<div id="modal" >

    <div >

        <h3>Modifier Emploi</h3>

        <form id="editForm" method="POST">
            @csrf

            <label>Jour</label>
            <select name="jour" id="jour">
                <option>Lundi</option>
                <option>Mardi</option>
                <option>Mercredi</option>
                <option>Jeudi</option>
                <option>Vendredi</option>
            </select>

            <label>Heure début</label>
            <input type="time" name="heure_debut" id="heure_debut">

            <label>Heure fin</label>
            <input type="time" name="heure_fin" id="heure_fin">

            <label>Salle</label>
            <select name="salle_id" id="salle_id">
                @foreach($salles as $s)
                    <option value="{{ $s->id }}">{{ $s->nom }}</option>
                @endforeach
            </select>

            <label>Enseignant</label>
            <select name="enseignant_id" id="enseignant_id">
                @foreach($enseignants as $ens)
                    <option value="{{ $ens->id }}">
                        {{ $ens->prenom }} {{ $ens->nom }}
                    </option>
                @endforeach
            </select>

            <br><br>

            <button type="submit">Modifier</button>
            <button type="button" onclick="closeModal()">Fermer</button>

        </form>

    </div>

</div>


<script>

function openModal(id, jour, debut, fin, salle, enseignant)
{
    document.getElementById('modal').style.display = 'block';

    document.getElementById('jour').value = jour;
    document.getElementById('heure_debut').value = debut;
    document.getElementById('heure_fin').value = fin;
    document.getElementById('salle_id').value = salle;
    document.getElementById('enseignant_id').value = enseignant;

    document.getElementById('editForm').action = "/emplois/update/" + id;
}

function closeModal()
{
    document.getElementById('modal').style.display = 'none';
}

</script>

@endsection