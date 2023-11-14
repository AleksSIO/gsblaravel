<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;

class connexionController extends Controller
{
    function connecter(){

        return view('connexion')->with('erreurs',null);
    }
    function valider(Request $request){
        $login = $request['login'];
        $mdp = $request['mdp'];
        $visiteur = PdoGsb::getInfosVisiteur($login,$mdp);
        $gestionnaire = PdoGsb::getInfosGestionnaire($login, $mdp);
        $comptable = PdoGsb::getInfosComptable($login, $mdp);
        if(!is_array($visiteur) && !is_array($gestionnaire) && !is_array($comptable)){
            $erreurs[] = "Login ou mot de passe incorrect(s)";
            return view('connexion')->with('erreurs',$erreurs);
        }
        else if(!is_array($gestionnaire) && !is_array($comptable)){
            session(['visiteur' => $visiteur]);
            return view('sommaire')->with('visiteur',session('visiteur'));
        }
        else if(!is_array($comptable)){
            session(['gestionnaire' => $gestionnaire]);
            return view('sommaire')->with('gestionnaire',session('gestionnaire'));
        }
        else {
            session(['comptable' => $comptable]);
            return view('sommaire')->with('comptable',session('comptable'));
        }
    }
    function deconnecter(){
            session(['visiteur' => null]);
            session(['gestionnaire' => null]);
            session(['comptable' => null]);
            return redirect()->route('chemin_connexion');


    }

}
