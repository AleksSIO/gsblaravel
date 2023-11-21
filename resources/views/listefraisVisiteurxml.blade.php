<?xml version="1.0" encoding="UTF-8"?>
<root>
    
@foreach ($lesFraisVisiteur as $frais)
    <fiche>
        <periode>{{ substr($frais['mois'], 4, 2) . '/' . substr($frais['mois'], 0, 4) }}</periode>
        <ETP>{{ $frais['ETP'] }}</ETP>
        <KM>{{ $frais['KM'] }}</KM>
        <NUI>{{ $frais['NUI'] }}</NUI>
        <REP>{{ $frais['REP'] }}</REP>
    </fiche>
@endforeach

</root>