@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">

<h1>Gestion des Filières</h1>


<h2>Ajouter Filière</h2>

<form action="/filieres/store" method="POST">
    @csrf

    <input type="text"
           name="nom"
           placeholder="Nom Filière"
           class="form-control mb-2"
           required>

    <button type="submit" class="btn btn-primary">
        Ajouter
    </button>
</form>

<hr>


<h2>Liste des Filières</h2>

<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($filieres as $filiere)

        <tr>
            <td>{{ $filiere->id }}</td>

            <td>{{ $filiere->nom }}</td>

            <td>
                <button class="btn btn-warning"
                    onclick="openModal('{{ $filiere->id }}','{{ $filiere->nom }}')">
                    Modifier
                </button>
            </td>

        </tr>

        @endforeach

    </tbody>

</table>


<div id="modal" class="modal-overlay">

    <div class="modal-box" onclick="event.stopPropagation()">

        <h3>Modifier Filière</h3>

        <form id="updateForm" method="POST">

            @csrf
            @method('PUT')

            <label>Nom Filière</label>

            <input
                type="text"
                name="nom"
                id="nomInput"
                class="form-control mb-3"
                required
            >

            <button type="submit" class="btn btn-success">
                Modifier
            </button>

            <button type="button"
                    class="btn btn-secondary"
                    onclick="closeModal()">
                Fermer
            </button>

        </form>

    </div>

</div>


<style>

.modal-overlay{
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal-box{
    background:white;
    padding:30px;
    border-radius:10px;
    width:400px;
}

</style>


<script>

function openModal(id, nom)
{
    document.getElementById('modal').style.display = 'flex';

    document.getElementById('nomInput').value = nom;

    document.getElementById('updateForm').action =
        "/filieres/update/" + id;
}

function closeModal()
{
    document.getElementById('modal').style.display = 'none';
}

document.addEventListener('keydown', function(e){
    if(e.key === "Escape"){
        closeModal();
    }
});

</script>

@endsection