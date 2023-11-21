@extends ('sommaire')
@section('contenu1')
    <div class="w-full">
        <form action="{{ route('chemin_confirmerFrais')}}" method="post">
            {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->

            <table class="table-auto mx-auto">
            <caption class="my-4">Le frais -
                <a href="{{ route('chemin_validationFrais') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded justify-end">Choisir frais</a>

            </caption>
            <thead class="bg-gray-50 border-b-2 border-gray-200 ">
                <tr class="border-b dark:border-neutral-500">
                    <th class="w-5 text-center">#</th>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Nom</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Prenom</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Montant</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">date</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Etat</th>
                    <th class="w-28 p-3 text-sm font-semibold tracking-wide text-center">Action</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">V</th>

                </tr>
            </thead>
            <tbody>
                <tr class="bg-grey border-b">
                    <td class="p-3 text-sm text-gray-700"><input type="checkbox" name="id" value="{{$lefrais['id']}}"></td>

                    <td class="p-3 text-sm text-gray-700" > {{$lefrais['nom']}}</td>
                    <input type="hidden" name="nom" value="{{$lefrais['nom']}}">
                    <td class="p-3 text-sm text-gray-700">{{$lefrais['prenom']}}</td>
                    <input type="hidden" name="prenom" value="{{$lefrais['prenom']}}">
                    <td class="p-3 text-sm text-gray-700">{{$lefrais['montantValide']}}</td>
                    <input type="hidden" name="montantValide" value="{{$lefrais['montantValide']}}">
                    <td class="p-3 text-sm text-gray-700" >{{$lefrais['mois']}}</td>
                    <input type="hidden" name="mois" value="{{$lefrais['mois']}}">
                    <td class="p-3 text-sm text-gray-700" >{{$lefrais['libelle']}}</td>
                    <input type="hidden" name="libelle" value="{{$lefrais['libelle']}}">

                    <td class="p-3 text-sm text-gray-700" >
                        <select id="lesetats" name="lesetats">
                            @foreach($lesetats as $etats)
                                <option value="{{ $etats['id'] }}">{{ $etats['libelle']}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded justify-items-center"><!-- Modifier etat-->&#128393;</button>
                    </td>

                </tr>
            </tbody>
        </table>
        </form>
    </div>
@endsection
