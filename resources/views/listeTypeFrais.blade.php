@extends ('sommaire')
    @section('contenu1')
      <div class="w-full text-center">
          <h2 class="text-2xl font-semibold p-2 mb-4">Les fiches frais par type de frais</h2>
      <form action="{{ route('chemin_listeFraisType') }}" method="post">
        {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="corpsForm">
            <p>
              <label for="lstTypeFrais" >Type de frais à sélectionner: </label>
              <select id="lstTypeFrais" name="lstTypeFrais">
                  @foreach($lesTypesFrais as $frais)
                      @if ($frais['id'] == $keyType)
                        <option selected value="{{ $frais['id'] }}">{{ $frais['libelle'] }}</option>
                      @else
                        <option value="{{ $frais['id']}}">{{ $frais['libelle'] }}</option>
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