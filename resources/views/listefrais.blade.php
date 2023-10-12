@extends ('sommaire')
@section('contenu1')


<div class="overflow-auto rounded-lg">
    <div class="text-center">
        <h2 class="text-2xl font-semibold mb-4">Renseigner ma fiche de frais du mois {{ $numMois }}-{{ $numAnnee }}</h2>
        <p>
            Etat : <strong>{{ $libEtat }} depuis le {{ $dateModif }} </strong><br>

            Montant validé : <strong>{{ $montantValide }} </strong>
        </p>
    </div>
    <table class="w-full table-fixed">
        <caption class="caption-top">
            <h3> Eléments forfaitisés </h3>
        </caption>
        <thead class="bg-gray-50 border-b-2 border-gray-200 ">
        <tr class="border-b dark:border-neutral-500">
            @foreach($lesFraisForfait as $unFraisForfait)
                <th class="p-3 text-sm font-semibold tracking-wide text-left"> {{$unFraisForfait['libelle']}} </th>
            @endforeach

        </tr>
        </thead>
        <tbody>
        <tr class="bg-grey border-b">
            @foreach($lesFraisForfait as $unFraisForfait)
                <td class="p-3 text-sm text-gray-700">{{ $unFraisForfait['quantite'] }}</td>
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
@endsection
