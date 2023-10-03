<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
class listeVisiteursController extends Controller
{
    function listeVisiteurs(){
        if(session('gestionnaire') != null){
            $lesVisiteurs = PdoGsb::listeVisiteurs();
            return view('listeVisiteurs')
                        ->with('lesVisiteurs', $lesVisiteurs);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }



}
