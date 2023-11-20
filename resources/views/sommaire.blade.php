@extends ('modeles/visiteur')
    @section('menu')
        <div class="bg-blue-500 w-2/8 h-screen p-4">
            <!-- Navigation links -->
            <div><img src="{{ asset('images/logo-preview.png')}}" alt="GSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin" ></div>
            <nav class="text-white">
                <h2 class="text-2xl font-semibold mb-4">Navigation</h2>
                <ul class="p-2">
                    @isset($visiteur)
                        <li >
                            <strong>Bonjour {{ $visiteur['nom'] . ' ' . $visiteur['prenom'] }}</strong>
                        </li>

                        <li class="mb-2">
                            <a href="{{ route('chemin_gestionFrais')}}" title="Saisie fiche de frais ">Saisie fiche de frais</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('chemin_selectionMois') }}" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
                        </li>
                    @endisset
                    @isset($gestionnaire)
                        <li >
                            <strong>Bonjour {{ $gestionnaire['nom'] . ' ' . $gestionnaire['prenom'] }}</strong>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('chemin_gestionVisiteurs') }}" title="Gestion des visiteurs">Gestion des visiteurs</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('chemin_selectionAnnee') }}" title="Année Fiche Frais">Fiches frais par année</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('chemin_selectionVisiteur') }}" title="Visiteur Fiche Frais">Fiches frais par visiteur</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('chemin_selectionTypeFrais') }}" title="Type Fiche Frais">Fiches frais par type</a>
                        </li>

                    @endisset
                    @isset($comptable)
                        <li >
                            <strong>Bonjour {{ $comptable['nom'] . ' ' . $comptable['prenom'] }}</strong>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('chemin_gestionVisiteurs') }}" title="Gestion des visiteurs">Gestion des visiteurs</a>
                        </li>

                    @endisset
                    <li class="mb-2">
                        <a href="{{ route('chemin_deconnexion') }}" title="Se déconnecter">Déconnexion</a>
                    </li>
                </ul>
            </nav>
        </div>

    @endsection
