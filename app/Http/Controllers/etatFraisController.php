<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PdoGsb;
use MyDate;
class etatFraisController extends Controller
{
    function selectionnerMois(){
        if(session('visiteur') != null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $lesMois = PdoGsb::getLesMoisDisponibles($idVisiteur);
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesMois );
		    $moisASelectionner = $lesCles[0];
            return view('listemois')
                        ->with('lesMois', $lesMois)
                        ->with('leMois', $moisASelectionner)
                        ->with('visiteur',$visiteur);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }

    function selectionnerAnnee(){
        if(session('gestionnaire') != null){
            $lesAnnees = PdoGsb::getLesAnnees();
            $gestionnaire = session('gestionnaire');
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesAnnees );
		    $anneeASelectionner = $lesCles[0];
            return view('listeAnneeFrais')
                        ->with('lesAnnees', $lesAnnees)
                        ->with('lAnnee', $anneeASelectionner)
                        ->with('gestionnaire',$gestionnaire);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function voirFrais(Request $request){
        if( session('visiteur')!= null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $leMois = $request['lstMois']; 
		    $lesMois = PdoGsb::getLesMoisDisponibles($idVisiteur);
            $lesFraisForfait = PdoGsb::getLesFraisForfait($idVisiteur,$leMois);
		    $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($idVisiteur,$leMois);
		    $numAnnee = MyDate::extraireAnnee( $leMois);
		    $numMois = MyDate::extraireMois( $leMois);
		    $libEtat = $lesInfosFicheFrais['libEtat'];
		    $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif =  $lesInfosFicheFrais['dateModif'];
            $dateModifFr = MyDate::getFormatFrançais($dateModif);
            $vue = view('listefrais')->with('lesMois', $lesMois)
                    ->with('leMois', $leMois)->with('numAnnee',$numAnnee)
                    ->with('numMois',$numMois)->with('libEtat',$libEtat)
                    ->with('montantValide',$montantValide)
                    ->with('nbJustificatifs',$nbJustificatifs)
                    ->with('dateModif',$dateModifFr)
                    ->with('lesFraisForfait',$lesFraisForfait)
                    ->with('visiteur',$visiteur);
            return $vue;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function voirFraisAnnee(Request $request){
        if( session('gestionnaire')!= null){
            $gestionnaire = session('gestionnaire');
            $lAnnee = $request['lstAnnee']; 
		    $lesAnnees = PdoGsb::getLesAnnees();
            $lesFraisAnnee = PdoGsb::getLesFichesFraisParAnnee($lAnnee);
            $vue = view('listefraisAnnee')->with('lesAnnees', $lesAnnees)
                    ->with('lesFraisAnnee', $lesFraisAnnee)
                    ->with('lAnnee', $lAnnee)
                    ->with('gestionnaire',$gestionnaire);
            return $vue;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function selectionnerVisiteur(){
        if(session('gestionnaire') != null){
            $lesVisiteurs = PdoGsb::listeVisiteurs();
            $gestionnaire = session('gestionnaire');
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesVisiteurs );
		    $visiteurASelectionner = $lesCles[0];
            return view('listeVisiteurFrais')
                        ->with('lesVisiteurs', $lesVisiteurs)
                        ->with('keyVisiteur', $visiteurASelectionner)
                        ->with('gestionnaire',$gestionnaire);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function voirFraisVisiteur(Request $request){
        if( session('gestionnaire')!= null){
            $gestionnaire = session('gestionnaire');
            $leVisiteur = $request['lstVisiteur']; 
		    $lesVisiteurs = PdoGsb::listeVisiteurs();
            $lesFraisVisiteur = PdoGsb::getLesFichesFraisParVisiteur($leVisiteur);
            $vue = view('listefraisVisiteur')->with('lesVisiteurs', $lesVisiteurs)
                    ->with('lesFraisVisiteur', $lesFraisVisiteur)
                    ->with('leVisiteur', $leVisiteur)
                    ->with('gestionnaire',$gestionnaire);
            return $vue;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function selectionnerTypeFrais(){
        if(session('gestionnaire') != null){
            $lesTypesFrais = PdoGsb::getLesTypes();
            $gestionnaire = session('gestionnaire');
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesTypesFrais );
		    $fraisASelectionner = $lesCles[0];
            return view('listeTypeFrais')
                        ->with('lesTypesFrais', $lesTypesFrais)
                        ->with('keyType', $fraisASelectionner)
                        ->with('gestionnaire',$gestionnaire);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function voirFraisType(Request $request){
        if( session('gestionnaire')!= null){
            $gestionnaire = session('gestionnaire');
            $leTypeFrais = $request['lstTypeFrais']; 
		    $lesTypesFrais = PdoGsb::getLesTypes();
            $lesFraisType = PdoGsb::getLesFichesFraisParType($leTypeFrais);
            $vue = view('listefraisType')->with('lesTypesFrais', $lesTypesFrais)
                    ->with('lesFraisType', $lesFraisType)
                    ->with('leTypeFrais', $leTypeFrais)
                    ->with('gestionnaire',$gestionnaire);
            return $vue;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    public function genererTypeFraisXML(Request $request)
    {
        $leTypeFrais = $request['typeFrais']; 
        $lesFraisType = PdoGsb::getLesFichesFraisParType($leTypeFrais);// ... obtenir vos données

        $xmlContent = view('listefraisTypexml', compact('lesFraisType'))->render();

        // Enregistrez le contenu XML dans un fichier temporaire
        $tempFilePath = tempnam(sys_get_temp_dir(), 'fichesTypefrais');
        file_put_contents($tempFilePath, $xmlContent);

        // Définir le nom du fichier à télécharger
        $fileName = 'fichesTypefrais.xml';

        $headers = [
            'Content-Type' => 'application/xml',
        ];

        // Retourner une réponse de téléchargement avec le fichier XML
        return response()->download($tempFilePath, $fileName, $headers)->deleteFileAfterSend(true);
    }

    public function genererAnneeFraisXML(Request $request)
    {
        $lAnnee = $request['anneeFrais']; 
        $lesFraisAnnee = PdoGsb::getLesFichesFraisParAnnee($lAnnee);

        $xmlContent = view('listefraisAnneexml', compact('lesFraisAnnee'))->render();

        // Enregistrez le contenu XML dans un fichier temporaire
        $tempFilePath = tempnam(sys_get_temp_dir(), 'fichesAnneefrais');
        file_put_contents($tempFilePath, $xmlContent);

        // Définir le nom du fichier à télécharger
        $fileName = 'fichesAnneefrais.xml';

        $headers = [
            'Content-Type' => 'application/xml',
        ];

        // Retourner une réponse de téléchargement avec le fichier XML
        return response()->download($tempFilePath, $fileName, $headers)->deleteFileAfterSend(true);
    }

    public function genererVisiteurFraisXML(Request $request)
    {
        $leVisiteur = $request['visiteurFrais']; 
        $lesFraisVisiteur = PdoGsb::getLesFichesFraisParVisiteur($leVisiteur);

        $xmlContent = view('listefraisVisiteurxml', compact('lesFraisVisiteur'))->render();

        // Enregistrez le contenu XML dans un fichier temporaire
        $tempFilePath = tempnam(sys_get_temp_dir(), 'fichesVisiteurfrais');
        file_put_contents($tempFilePath, $xmlContent);

        // Définir le nom du fichier à télécharger
        $fileName = 'fichesVisiteurfrais.xml';

        $headers = [
            'Content-Type' => 'application/xml',
        ];

        // Retourner une réponse de téléchargement avec le fichier XML
        return response()->download($tempFilePath, $fileName, $headers)->deleteFileAfterSend(true);
    }
}