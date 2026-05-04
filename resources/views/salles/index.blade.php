@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">


<h1>Gestion des Salles</h1>


<h2>Ajouter Salle</h2>

<form action="/salles/store" method="POST">
    @csrf

    <input type="text" name="nom" placeholder="Nom salle" class="form-control mb-2">

    <input type="number" name="capacite" placeholder="Capacité" class="form-control mb-2">

    <button type="submit" class="btn btn-primary">
        Ajouter
    </button>
</form>

<hr>


<h2>Liste des Salles</h2>

<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Capacité</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @foreach($salles as $s)

        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->nom }}</td>
            <td>{{ $s->capacite }}</td>

            <td>
                <button class="btn btn-warning btn-sm"
                    onclick="openModal('{{ $s->id }}','{{ $s->nom }}','{{ $s->capacite }}')">
                    Modifier
                </button>

                <a href="/salles/delete/{{ $s->id }}" class="btn btn-danger btn-sm">
                    Supprimer
                </a>
            </td>
        </tr>

        @endforeach

    </tbody>

</table>


<div class="modal" id="modal"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">

    <div style="background:white; padding:20px; width:400px; margin:10% auto;">

        <h3>Modifier Salle</h3>

        <form id="editForm" method="POST">
            @csrf

            <input type="text" name="nom" id="nom" class="form-control mb-2">

            <input type="number" name="capacite" id="capacite" class="form-control mb-2">

            <button type="submit" class="btn btn-primary">Modifier</button>

            <button type="button" class="btn btn-secondary" onclick="closeModal()">
                Fermer
            </button>
        </form>

    </div>

</div>


<script>

function openModal(id, nom, capacite)
{
    document.getElementById('modal').style.display = 'block';

    document.getElementById('nom').value = nom;
    document.getElementById('capacite').value = capacite;

    document.getElementById('editForm').action = "/salles/update/" + id;
}

function closeModal()
{
    document.getElementById('modal').style.display = 'none';
}

</script>

@endsection