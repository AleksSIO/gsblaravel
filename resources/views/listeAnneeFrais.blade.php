@extends ('sommaire')
    @section('contenu1')
      <div class="w-full text-center">
          <h2 class="text-2xl font-semibold p-2 mb-4">Les fiches frais par année</h2>
      <form action="{{ route('chemin_listeFraisAnnee') }}" method="post">
        {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="corpsForm">
            <p>
              <label for="lstAnnee" >Année à sélectionner: </label>
              <select id="lstAnnee" name="lstAnnee">
                  @foreach($lesAnnees as $annee)
                      @if ($annee['annee'] == $lAnnee)
                        <option selected value="{{ $annee['annee'] }}">{{ $annee['annee'] }}</option>
                      @else
                        <option value="{{ $annee['annee']}}">{{ $annee['annee'] }}</option>
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