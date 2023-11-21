<?xml version="1.0" encoding="UTF-8"?>
<root>

@foreach ($lesFraisAnnee as $frais)
    <fiche>
        <visiteur>{{ $frais['numVisiteur'] }}</visiteur>
        <ETP>{{ $frais['ETP'] }}</ETP>
        <KM>{{ $frais['KM'] }}</KM>
        <NUI>{{ $frais['NUI'] }}</NUI>
        <REP>{{ $frais['REP'] }}</REP>
    </fiche>
@endforeach

</root>