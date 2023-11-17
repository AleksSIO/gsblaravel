<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;

class gererVisiteursController extends Controller
{

    function voirLesVisiteurs(Request $request){
        if( session('gestionnaire')!= null){
            $gestionnaire = session('gestionnaire');
		    $lesVisiteurs = PdoGsb::getListeVisiteurs();
            return view('listeVisiteurs')->with('lesVisiteurs', $lesVisiteurs);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function afficherModifier(Request $request,$id){
        $monVisiteur = PdoGsb::unVisiteur($id);
        if(session('gestionnaire') != null){
            $gestionnaire = session('gestionnaire');
            $view = view('modifierVisiteur')
                ->with('gestionnaire',$gestionnaire)
                ->with('monVisiteur',$monVisiteur);
        }else{
            $view = view('connexion')->with('erreurs',null);
        }
        return $view;

    }

    function sauvegarderModifier(Request $request)
    {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $dateEmbauche = $_POST['dateEmbauche'];

        $lesVisiteurs = PdoGsb::listeVisiteurs();
        $etatmodiff = PdoGsb::modifierVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche);
        if(session('gestionnaire') != null){
            $gestionnaire = session('gestionnaire');
            $view = view('listeVisiteurs')
                ->with('lesVisiteurs',$lesVisiteurs)
                ->with('gestionnaire',$gestionnaire);
        }else{
            $view = view('connexion')->with('erreurs',null);
        }
        return $view;
    }

    function supprimerVisiteur(Request $request,$id){
        $ide = $id;
        $etatSupp = PdoGsb::suppVisiteur($id);
        $lesVisiteurs = PdoGsb::listeVisiteurs();
        if(session('gestionnaire') != null){
            $gestionnaire = session('gestionnaire');
            $view = view('listeVisiteurs')
                ->with('lesVisiteurs',$lesVisiteurs)
                ->with('gestionnaire',$gestionnaire);
        }else{
            $view = view('connexion')->with('erreurs',null);
        }
        return $view;
    }

    function ajouterVisiteur(Request $request)
    {
        if(session('gestionnaire') != null){
            $gestionnaire = session('gestionnaire');
            $view = view('modifierVisiteur')
                ->with('gestionnaire',$gestionnaire);
        }else{
            $view = view('connexion')->with('erreurs',null);
        }
        return $view;
    }

    function confirmajouterVisiteur(Request $request)
    {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $dateEmbauche = $_POST['dateEmbauche'];
        $etatinserer = PdoGsb::insererVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche);
        $lesVisiteurs = PdoGsb::listeVisiteurs();
        if(session('gestionnaire') != null){
            $gestionnaire = session('gestionnaire');
            $view = view('listeVisiteurs')
                ->with('lesVisiteurs',$lesVisiteurs)
                ->with('gestionnaire',$gestionnaire);
        }else{
            $view = view('connexion')->with('erreurs',null);
        }
        return $view;
    }
}
