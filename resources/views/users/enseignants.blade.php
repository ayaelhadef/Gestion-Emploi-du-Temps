@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">


<h1>Gestion des Enseignants</h1>

<!-- ===================== -->
<!-- FORM AJOUT -->
<!-- ===================== -->

<h2>Ajouter Enseignant</h2>

<form action="/enseignants/store" method="POST">
    @csrf

    <input type="text" name="prenom" placeholder="Prenom" required class="form-control mb-2">

    <input type="text" name="nom" placeholder="Nom" required class="form-control mb-2">

    <input type="date" name="date_naissance" required class="form-control mb-2">

    <input type="text" name="adresse" placeholder="Adresse" class="form-control mb-2">

    <input type="email" name="email" placeholder="Email" required class="form-control mb-2">

    <button type="submit" class="btn btn-primary">
        Ajouter Enseignant
    </button>
</form>

<hr>



<h2>Liste des Enseignants</h2>

<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>

    <tbody>

        @foreach($users as $user)

        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->prenom }}</td>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
        </tr>

        @endforeach

    </tbody>

</table>

@endsection