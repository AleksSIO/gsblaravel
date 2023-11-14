<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PDF;
use PdoGsb;

class PDFController extends Controller
{
    public function genererPDF()
    {
        $lesVisiteurs = PdoGsb::listeVisiteurs();

        $data = [
            'title' => 'Liste des visiteurs',
            'date'=> date('d/m/Y'),
            'lesVisiteurs' => $lesVisiteurs
        ];

        $pdf = PDF::loadView('PDFListeVisiteurs', $data);

        return $pdf->download('listevisiteurs.pdf');
    }
}
?>