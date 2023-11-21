@extends ('sommaire')
    @section('contenu1')
      <div class="w-full text-center">
          <h2 class="text-2xl font-semibold p-2 mb-4">Les fiches frais par année</h2>
      <form action="{{ route('chemin_listeFraisVisiteur') }}" method="post">
        {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="corpsForm">
            <p>
              <label for="lstVisiteur" >Visiteur à sélectionner: </label>
              <select id="lstVisiteur" name="lstVisiteur">
                  @foreach($lesVisiteurs as $_visiteur)
                      @if ($_visiteur['id'] == $keyVisiteur)
                        <option selected value="{{ $_visiteur['id'] }}">{{ $_visieur['prenom'] . " " . $_visiteur['nom'] }}</option>
                      @else
                        <option value="{{ $_visiteur['id'] }}">{{ $_visiteur['prenom'] . " " . $_visiteur['nom'] }}</option>
                      @endif
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