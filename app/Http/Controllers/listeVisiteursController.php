<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;

class listeVisiteursController extends Controller
{

    function lister(Request $request){
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
