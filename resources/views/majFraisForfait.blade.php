@extends ('sommaire')
@section('contenu1')
    <div id="contenu" class="max-w-2xl mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Renseigner ma fiche de frais du mois {{ $numMois }}-{{ $numAnnee }}</h2>
        <form method="post" action="{{ route('chemin_sauvegardeFrais') }}">
            {{ csrf_field() }} <!-- Laravel va ajouter un champ caché avec un token -->
            <div class="corpsForm">
                <fieldset>
                    <div class="text-center">
                        <legend class="text-center text-lg font-semibold">Eléments forfaitisés</legend></div>
                    @includeWhen($erreurs != null, 'msgerreurs', ['erreurs' => $erreurs])
                    @includeWhen($message != "", 'message', ['message' => $message])
                    @foreach ($lesFrais as $key => $frais)
                        <div class="mb-4">
                            <input type="hidden" name="lesLibFrais[]"
                                   @if($method == 'GET')
                                       value="{{ $frais['libelle'] }}"
                                   @else
                                       value="{{ $lesLibFrais[$loop->index] }}"
                                @endif>
                            <label for="idFrais" class="block text-gray-700">
                                @if($method == 'GET')
                                    {{ $frais['libelle'] }}
                                @else
                                    {{ $lesLibFrais[$loop->index] }}
                                @endif
                            </label>
                            <input type="text" required
                                   @if($method == 'GET')
                                       name="lesFrais[{{ $frais['idfrais'] }}]"
                                   value="{{ $frais['quantite'] }}"
                                   @else
                                       name="lesFrais[{{ $key }}]"
                                   value="{{ $frais }}"
                                   @endif
                                   class="w-full p-2 border border-gray-300 rounded"
                            >
                        </div>
                    @endforeach
                </fieldset>
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

