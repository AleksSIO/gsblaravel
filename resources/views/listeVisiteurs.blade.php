@extends ('sommaire')
@section('contenu1')

    <div class="w-full">
        <table class="table-auto mx-auto">
            <caption>Liste des visiteurs </caption>
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
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded justify-end"><!-- Modifier -->&#128393;</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-2 rounded justify-end"><!--Supprimer -->&#10060;</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
