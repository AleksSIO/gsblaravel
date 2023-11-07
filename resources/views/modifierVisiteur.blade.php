@extends ('sommaire')
@section('contenu1')
    <div id="contenu" class="max-w-2xl mx-auto p-4">
        @isset($monVisiteur)
            <h2 class="text-2xl font-semibold mb-4">Modifier mon visiteur</h2>
            <form method="post" action="{{ route('modifierVisiteurs')}}">
        @else
            <h2 class="text-2xl font-semibold mb-4">Inserer mon visiteur</h2>
            <form method="post" action="{{ route('sendVisiteurs')}}">
        @endisset
            {{ csrf_field() }}
            <div class="corpsForm">
            @isset($monVisiteur)
                    <input type="hidden" value="{{ $monVisiteur['id'] }}" name="id">
                    <label>Nom<br>
                        <input type="text" value="{{ $monVisiteur['nom'] }}" name="nom"><br>
                    </label>
                    <label>Prenom<br>
                        <input type="text" value="{{ $monVisiteur['prenom'] }}" name="prenom"><br>
                    </label>
                    <label>login<br>
                        <input type="text" value="{{ $monVisiteur['login'] }}" name="login"><br>
                    </label>
                    <label>Mot de passe<br>
                        <input type="text" value="{{ $monVisiteur['mdp'] }}" name="mdp"><br>
                    </label>
                    <label>Adresse<br>
                        <input type="text" value="{{ $monVisiteur['adresse'] }}" name="adresse"><br>
                    </label>
                    <label>cp<br>
                        <input type="text" value="{{ $monVisiteur['cp'] }}" name="cp"><br>
                    </label>
                    <label>Ville<br>
                        <input type="text" value="{{ $monVisiteur['ville'] }}" name="ville"><br>
                    </label>
                    <label>Date embauche<br>
                        <input type="text" value="{{ $monVisiteur['dateEmbauche'] }}" name="dateEmbauche"><br>
                    </label>
                @else
                    <label>Id<br>
                        <input type="text" value="" name="id"><br>
                    </label>
                    <label>Nom<br>
                        <input type="text" value="" name="nom"><br>
                    </label>
                    <label>Prenom<br>
                        <input type="text" value="" name="prenom"><br>
                    </label>
                    <label>login<br>
                        <input type="text" value="" name="login"><br>
                    </label>
                    <label>Mot de passe<br>
                        <input type="text" value="" name="mdp"><br>
                    </label>
                    <label>Adresse<br>
                        <input type="text" value="" name="adresse"><br>
                    </label>
                    <label>cp<br>
                        <input type="text" value="" name="cp"><br>
                    </label>
                    <label>Ville<br>
                        <input type="text" value="" name="ville"><br>
                    </label>
                    <label>Date embauche - Ex : 2023-10-19<br>
                        <input type="text" value="" name="dateEmbauche"><br>
                    </label>
                @endisset
            </div>
            <div class="piedForm">
                <div class="mt-4">
                    <input id="ok" type="submit" value="Valider" class="bg-blue-500 text-white p-2 px-4 rounded hover:bg-blue-700">
                    <input id="annuler" type="reset" value="Annuler" class="bg-gray-300 text-gray-700 p-2 px-4 rounded hover:bg-gray-400">
                </div>
            </div>
        </form>
    </div>
@endsection

