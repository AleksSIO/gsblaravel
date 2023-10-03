@extends ('listeVisiteurs')
@section('contenu2')

    <h3>Liste des visiteurs :
    </h3>
    <div class="encadre">
        <table class="listeLegere">
            <caption>Liste des visiteurs </caption>
            <th></th>
            <th>Nom</th>
            <th>Prénom</th>
                @foreach($lesVisiteurs as $unVisiteur)
                    <tr>
                        <td><input type="radio" name="id" value="{{$unVisiteur['id']}}"</td>
                        <td> {{$unVisiteur['nom']}} </td>
                        <td> {{$unVisiteur['prenom']}} </td>
                    </tr>
                @endforeach
        </table>
    </div>
@endsection
