@extends ('sommaire')
@section('contenu1')

    <div class="w-full">
    <div class="my-4 w-full 2xl:ml-[39%] sm:ml-[25%]">Liste des visiteurs -
                <a href="{{ route('ajouterVisiteurs') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded justify-end">Ajouter visiteur</a>
                <a href="{{ route('genererPDF') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded justify-end">Générer PDF</a>

</div>
        <table class="table-auto mx-auto">

            <thead class="bg-gray-50 border-b-2 border-gray-200 ">

            <tr class="border-b dark:border-neutral-500">
                <th class="w-5 text-center">#</th>
                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Nom</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">Prenom</th>
                <th class="w-28 p-3 text-sm font-semibold tracking-wide text-center">Action</th>

            </tr>
            </thead>
            <tbody>

            @foreach($lesVisiteurs as $unVisiteur)
                <tr class="bg-grey border-b">
                    <td class="p-3 text-sm text-gray-700"><input type="checkbox" name="id" value="{{$unVisiteur['id']}}"></td>
                    <td class="p-3 text-sm text-gray-700">{{$unVisiteur['nom']}}</td>
                    <td class="p-3 text-sm text-gray-700">{{$unVisiteur['prenom']}}</td>
                    <td>
                        <div class="flex justify-center space-x-1">
                            <a href="{{ route('chemin_modifierVisiteurs', $id=$unVisiteur['id']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded justify-end"><!-- Modifier -->&#128393;</a>
                            <a href="{{ route('supprimerVisiteurs', $id=$unVisiteur['id']) }}" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-2 rounded justify-end"><!--Supprimer -->&#10060;</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
