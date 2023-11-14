<!DOCTYPE html>
<html>
<head>
    <title>Liste des visiteurs</title>
</head>
<style>
 body {
    background: #dcf2fa;
    color: black;
 }

 table {
    table-layout: auto;
    margin-left: auto;
    margin-right: auto;
 }

 h1{
    text-align: center;
 }

 p{
    text-align: right;
    margin-right: 2%;
 }
</style>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lesVisiteurs as $visiteur)
        <tr>
            <td>{{ $visiteur['nom'] }}</td>
            <td>{{ $visiteur['prenom'] }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>