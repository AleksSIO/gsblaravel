@extends ('sommaire')
@section('contenu1')
    <div class="w-full text-center">
        <h2 class="text-2xl font-semibold p-2 mb-4">Visiteur à sélectionner:</h2>
        @if($errors->any())
            <h4>{{ $errors->first() }}</h4>
        @endif

        <form action="{{ route('chemin_getFrais') }}" method="post">
            {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
            <div class="corpsForm">
                <p>

                    <label for="nom" >Nom : </label>
                    <select id="nom" name="nom">
                        @foreach($lesnoms as $nom)
                            <option value="{{ $nom['nom'] }}">{{ $nom['nom']}}</option>
                        @endforeach
                    </select>
                    <label for="prenom" >Prenom : </label>
                    <select id="prenom" name="prenom">
                        @foreach($lesprenoms as $prenom)
                            <option value="{{ $prenom['prenom'] }}">{{ $prenom['prenom']}}</option>
                        @endforeach
                    </select>
                    <label for="date" >Date : </label>
                    <select id="date" name="date">
                        @foreach($lesdates as $date)
                            <option value="{{ $date['mois'] }}">{{ $date['mois']}}</option>
                        @endforeach
                    </select>
                </p>
            </div>
            <div class="piedForm">
                <div class="mt-4">
                    <input id="ok" type="submit" value="Valider" class="bg-blue-500 text-white p-2 px-4 rounded hover:bg-blue-700">
                    <input id="annuler" type="reset" value="Annuler" class="bg-gray-300 text-gray-700 p-2 px-4 rounded hover:bg-gray-400">
                </div>
            </div>
        </form>
@endsection
