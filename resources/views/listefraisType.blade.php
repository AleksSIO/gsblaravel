@extends ('sommaire')
@section('contenu1')


<div class="overflow-auto rounded-lg">
    <div class="text-center flex items-center justify-center flex-col">
        <h2 class="text-2xl font-semibold mb-4">Fiches frais par type</h2>
        <div class="flex space-x-4">
        <a href="{{ route('chemin_selectionTypeFrais') }}"><button class=" bg-blue-500 text-white py-2 px-4 mb-6 rounded hover:bg-blue-700">Retour</button></a>
        <form method="post" action="{{ route('genererTypeFraisXML') }}" class="flex items-center">
            <input type="hidden" value="{{ $leTypeFrais }}" name="typeFrais">
            {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
            <input type='submit' class=" bg-blue-500 text-white py-2 px-4 mb-6 rounded hover:bg-blue-700" value="Générer XML"></a>
        </form>
        </div>
    </div>
  
    <table class="w-full table-fixed">
        <caption class="caption-top">
            <h3> Fiches de type : {{ $leTypeFrais }} </h3>
        </caption>
        <thead class="bg-gray-50 border-b-2 border-gray-200 ">
        <tr class="border-b dark:border-neutral-500">
                <th class="p-3 text-sm font-semibold tracking-wide text-left">Visiteur</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">Période</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">Montant</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($lesFraisType as $frais ) 
        <tr class="bg-grey border-b">
            <td class="p-3 text-sm text-gray-700">{{ $frais['idVisiteur'] }}</td>
            <td class="p-3 text-sm text-gray-700">{{ substr($frais['mois'],4,2).'/'.substr($frais['mois'],0,4) }}</td>
            <td class="p-3 text-sm text-gray-700">{{ $frais['montant'] }}</td>
         </tr> 
        @endforeach
        </tbody>
    </table>
</div>
@endsection
