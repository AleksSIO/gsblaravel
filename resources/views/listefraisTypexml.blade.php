<?xml version="1.0" encoding="UTF-8"?>
<root>

@foreach ($lesFraisType as $frais)
    <fiche>
        <visiteur>{{ $frais['idVisiteur'] }}</visiteur>
        <periode>{{ substr($frais['mois'], 4, 2) . '/' . substr($frais['mois'], 0, 4) }}</periode>
        <montant>{{ $frais['montant'] }}</montant>
    </fiche>
@endforeach

</root>