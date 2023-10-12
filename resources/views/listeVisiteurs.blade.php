@extends ('sommaire')
@section('contenu1')

    <div class="w-full">
        <table class="w-full">
            <caption>Liste des visiteurs </caption>

            <tr class="border-b dark:border-neutral-500">
                <th class="w-5 text-center">#</th>
                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Nom</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">Prenom</th>
                <th class="text-left">Modifier</th>
                <th class="text-left">Supprimer</th>
            </tr>

            @foreach($lesVisiteurs as $unVisiteur)
                <tr class="bg-grey border-b">
                    <td class="p-3 text-sm text-gray-700"><input type="checkbox" name="id" value="{{$unVisiteur['id']}}"></td>
                    <td class="p-3 text-sm text-gray-700">{{$unVisiteur['nom']}}</td>
                    <td class="p-3 text-sm text-gray-700">{{$unVisiteur['prenom']}}</td>
                    <td class="relative"> <button class="static right-0  bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-3 rounded justify-end">Button </button></td>
                    <td> <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded justify-end">Button </button></td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
