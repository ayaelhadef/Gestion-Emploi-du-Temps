@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">


<h1>Gestion des Etudiants</h1>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table, th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background: #f2f2f2;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
    }

    .modal-content {
        background: white;
        padding: 20px;
        width: 400px;
        margin: 6% auto;
        border-radius: 10px;
    }

    .close {
        float: right;
        cursor: pointer;
        font-size: 20px;
    }
</style>


<h2>Ajouter Etudiant</h2>

<form action="/etudiants/store" method="POST" class="p-3">
    @csrf

    <div class="row g-3">

        
        <div class="col-md-4">
            <input type="text" name="prenom" placeholder="Prénom" required class="form-control">
        </div>

        <div class="col-md-4">
            <input type="text" name="nom" placeholder="Nom" required class="form-control">
        </div>

        <div class="col-md-4">
            <input type="date" name="date_naissance" required class="form-control">
        </div>

        
        <div class="col-md-4">
            <input type="text" name="adresse" placeholder="Adresse" class="form-control">
        </div>

        <div class="col-md-4">
            <input type="email" name="email" placeholder="Email" required class="form-control">
        </div>

        <div class="col-md-4">
            <input type="text" name="numero_etudiant" placeholder="Numéro Étudiant" class="form-control">
        </div>

        
        <div class="col-md-6">
            <select name="filiere_id" class="form-control">
                <option value="">Choisir Filière</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <select name="semestre_id" class="form-control">
                <option value="">Choisir Semestre</option>
                @foreach($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{ $semestre->nom }}</option>
                @endforeach
            </select>
        </div>

        
<div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary px-4">
                Ajouter Étudiant
            </button>
        </div>

    </div>
</form>

<hr>



<h2>Liste des Etudiants</h2>

<table>

<tr>
    <th>ID</th>
    <th>Prenom</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Numero</th>
    <th>Filiere</th>
    <th>Semestre</th>
    <th>Actions</th>
</tr>

@foreach($users as $user)

<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->prenom }}</td>
    <td>{{ $user->nom }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->numero_etudiant }}</td>
    <td>{{ $user->filiere->nom ?? '-' }}</td>
    <td>{{ $user->semestre->nom ?? '-' }}</td>

    <td>

        <button onclick="openModal(
            '{{ $user->id }}',
            '{{ $user->prenom }}',
            '{{ $user->nom }}',
            '{{ $user->date_naissance }}',
            '{{ $user->adresse }}',
            '{{ $user->email }}',
            '{{ $user->numero_etudiant }}',
            '{{ $user->filiere_id }}',
            '{{ $user->semestre_id }}'
        )">
            Modifier
        </button>

        <a href="/users/delete/{{ $user->id }}">
            Supprimer
        </a>

    </td>
</tr>

@endforeach

</table>


<div id="modal" class="modal">

    <div class="modal-content">

        <span class="close" onclick="closeModal()">&times;</span>

        <h3>Modifier Etudiant</h3>

        <form id="editForm" method="POST">
            @csrf

            <input type="text" name="prenom" id="prenom"><br><br>
            <input type="text" name="nom" id="nom"><br><br>
            <input type="date" name="date_naissance" id="date_naissance"><br><br>
            <input type="text" name="adresse" id="adresse"><br><br>
            <input type="email" name="email" id="email"><br><br>
            <input type="text" name="numero_etudiant" id="numero_etudiant"><br><br>

            <select name="filiere_id" id="filiere_id">
                <option value="">Filière</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                @endforeach
            </select>

            <br><br>

            <select name="semestre_id" id="semestre_id">
                <option value="">Semestre</option>
                @foreach($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{ $semestre->nom }}</option>
                @endforeach
            </select>

            <br><br>

            <button type="submit">Enregistrer</button>

        </form>

    </div>

</div>


<script>

function openModal(id, prenom, nom, date_naissance, adresse, email, numero, filiere, semestre)
{
    document.getElementById('modal').style.display = 'block';

    document.getElementById('prenom').value = prenom;
    document.getElementById('nom').value = nom;
    document.getElementById('date_naissance').value = date_naissance;
    document.getElementById('adresse').value = adresse;
    document.getElementById('email').value = email;
    document.getElementById('numero_etudiant').value = numero;

    document.getElementById('filiere_id').value = filiere;
    document.getElementById('semestre_id').value = semestre;

    document.getElementById('editForm').action = "/etudiants/update/" + id;
}

function closeModal()
{
    document.getElementById('modal').style.display = 'none';
}

</script>

@endsection