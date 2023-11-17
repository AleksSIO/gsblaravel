@extends ('sommaire')
@section('contenu1')


<div class="overflow-auto rounded-lg">
    <div class="text-center">
        <h2 class="text-2xl font-semibold mb-4">Fiches frais par visiteur</h2>
        <a href="{{ route('chemin_selectionVisiteur') }}"><button class=" bg-blue-500 text-white py-2 px-4 mb-6 rounded hover:bg-blue-700">Retour</button></a>
    </div>
    <table class="w-full table-fixed">
        <caption class="caption-top">
            <h3> Fiche du visiteur : {{ $leVisiteur }} </h3>
        </caption>
        <thead class="bg-gray-50 border-b-2 border-gray-200 ">
        <tr class="border-b dark:border-neutral-500">

                <th class="p-3 text-sm font-semibold tracking-wide text-left">Période</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">ETP</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">KM</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">NUI</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">REP</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($lesFraisVisiteur as $frais ) 
        <tr class="bg-grey border-b">
            <td class="p-3 text-sm text-gray-700">{{ substr($frais['mois'],4,2).'/'.substr($frais['mois'],0,4) }}</td>
            <td class="p-3 text-sm text-gray-700">{{ $frais['ETP'] . ' €' }}</td>
            <td class="p-3 text-sm text-gray-700">{{ $frais['KM'] . ' €'}}</td>
            <td class="p-3 text-sm text-gray-700">{{ $frais['NUI'] . ' €'}}</td>
            <td class="p-3 text-sm text-gray-700">{{ $frais['REP'] . ' €'}}</td>
         </tr> 
        @endforeach
        </tbody>
    </table>
</div>
@endsection
