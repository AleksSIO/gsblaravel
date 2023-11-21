<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PdoGsb;
use MyDate;
class gererFraisController extends Controller{

    function saisirFrais(Request $request){
        if( session('visiteur') != null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $anneeMois = MyDate::getAnneeMoisCourant();
            $mois = $anneeMois['mois'];
            if(PdoGsb::estPremierFraisMois($idVisiteur,$mois)){
                 PdoGsb::creeNouvellesLignesFrais($idVisiteur,$mois);
            }
            $lesFrais = PdoGsb::getLesFraisForfait($idVisiteur,$mois);
            $view = view('majFraisForfait')
                    ->with('lesFrais', $lesFrais)
                    ->with('numMois',$anneeMois['numMois'])
                    ->with('erreurs',null)
                    ->with('numAnnee',$anneeMois['numAnnee'])
                    ->with('visiteur',$visiteur)
                    ->with('message',"")
                    ->with ('method',$request->method());
            return $view;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }
    /* Mission C */
    function validerFrais(Request $request){
        if( session('comptable') != null){
            $comptable = session('comptable');
            $lesnoms = PdoGsb::listeNomVisiteurs();
            $lesprenoms = PdoGsb::listePrenomVisiteurs();
            $lesdates = PdoGsb::listeMoisFraisForfait();


            $view = view('choixfrais')
                ->with('lesnoms',$lesnoms)
                ->with('lesprenoms',$lesprenoms)
                ->with('lesdates',$lesdates)
                ->with('comptable',$comptable)
                ->with('message',"")
                ->with ('method',$request->method());
            return $view;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }
    function getFrais(Request $request){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        if( session('comptable') != null){
            $comptable = session('comptable');
            $lefrais = PdoGsb::fraisbyName($nom,$prenom,$date);
            $lesetats = PdoGsb::lesetats();
            if(!is_array($lefrais)){
                $message = 'Indisponible';
                return Redirect::back()->withErrors('msg',$message);
            }else{
                $view = view('lefrais')
                    ->with('lefrais',$lefrais)
                    ->with('lesetats',$lesetats)
                    ->with('comptable',$comptable)
                    ->with('message',"")
                    ->with ('method',$request->method());
                return $view;

            }

        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }

    function confirmerFrais(Request $request)
    {
        $id = $request['id'];
        $nom  = $request['nom'];
        $prenom = $request['prenom'];
        $mois = $request['mois'];
        $montantValide = $request['montantValide'];
        $etat = $request['lesetats'];


dump($etat);
        if( session('comptable') != null){
            $comptable = session('comptable');
            $lefrais = PdoGsb::fraisbyName($nom,$prenom,$mois);
            $lesetats = PdoGsb::lesetats();

            if($etat =='VA'){  $valider = PdoGsb::validerfrais($id,$mois,$etat); }
            elseif($etat =='CL'){ $cloturer =  PdoGsb::cloturerfrais($id,$mois,$etat,0);}

            $view = view('lefrais')
                ->with('lefrais',$lefrais)
                ->with('lesetats',$lesetats)
                ->with('comptable',$comptable)
                ->with('message',"")
                ->with ('method',$request->method());
            return $view;

        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }
    function testconfirmerFrais(Request $request){
        $id = $request['id'];
        $nom  = $request['nom'];
        $prenom = $request['prenom'];
        $mois = $request['mois'];
        $lefrais = PdoGsb::fraisbyName($nom,$prenom,$mois);
        $montantValide = $request['montantValide'];
        if( session('comptable') != null){
            $comptable = session('comptable');

            $lesnoms = PdoGsb::listeNomVisiteurs();
            $lesprenoms = PdoGsb::listePrenomVisiteurs();
            $lesdates = PdoGsb::listeMoisFraisForfait();
            $view = view('choixfrais')
                ->with('comptable',$comptable)
                ->with('lesnoms',$lesnoms)

                ->with('lesprenoms',$lesprenoms)
                ->with('lesdates',$lesdates)
                ->with('message',"")
                ->with ('method',$request->method());
            return $view;

        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }
    function sauvegarderFrais(Request $request){
        if( session('visiteur')!= null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $anneeMois = MyDate::getAnneeMoisCourant();
            $mois = $anneeMois['mois'];
            $lesFrais = $request['lesFrais'];
            $lesLibFrais = $request['lesLibFrais'];
            $nbNumeric = 0;
            foreach($lesFrais as $unFrais){
                if(is_numeric($unFrais))
                    $nbNumeric++;
            }
            $view = view('majFraisForfait')->with('lesFrais', $lesFrais)
                    ->with('numMois',$anneeMois['numMois'])
                    ->with('numAnnee',$anneeMois['numAnnee'])
                    ->with('visiteur',$visiteur)
                    ->with('lesLibFrais',$lesLibFrais)
                    ->with ('method',$request->method());
            if($nbNumeric == 4){
                $message = "Votre fiche a été mise à jour";
                $erreurs = null;
                PdoGsb::majFraisForfait($idVisiteur,$mois,$lesFrais);
        	}
		    else{
                $erreurs[] ="Les valeurs des frais doivent être numériques";
                $message = '';
            }
            return $view->with('erreurs',$erreurs)
                        ->with('message',$message);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }
}














