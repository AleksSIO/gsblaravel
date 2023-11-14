<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
class gererVisiteurController extends Controller
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
}