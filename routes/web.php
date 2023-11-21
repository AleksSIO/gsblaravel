<?php
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
        /*-------------------- Use case connexion---------------------------*/
Route::get('/',[
        'as' => 'chemin_connexion',
        'uses' => 'connexionController@connecter'
]);

Route::post('/',[
        'as'=>'chemin_valider',
        'uses'=>'connexionController@valider'
]);
Route::get('deconnexion',[
        'as'=>'chemin_deconnexion',
        'uses'=>'connexionController@deconnecter'
]);

         /*-------------------- Use case état des frais---------------------------*/
Route::get('selectionMois',[
        'as'=>'chemin_selectionMois',
        'uses'=>'etatFraisController@selectionnerMois'
]);

Route::post('listeFrais',[
        'as'=>'chemin_listeFrais',
        'uses'=>'etatFraisController@voirFrais'
]);

        /*-------------------- Use case gérer les frais---------------------------*/

Route::get('gererFrais',[
        'as'=>'chemin_gestionFrais',
        'uses'=>'gererFraisController@saisirFrais'
]);

Route::post('sauvegarderFrais',[
        'as'=>'chemin_sauvegardeFrais',
        'uses'=>'gererFraisController@sauvegarderFrais'
]);
/*liste des visiteurs */
Route::get('listerVisiteurs',[
    'as'=>'chemin_gestionVisiteurs',
    'uses'=>'listeVisiteursController@lister'
]);
/*afficher les  visiteurs */

Route::get('modifierVisiteurs/{id}', [
    'as'=>'chemin_modifierVisiteurs',
    'uses'=>'gererVisiteursController@afficherModifier'
]);
Route::post('modifierVisiteurs',[
    'as'=>'modifierVisiteurs',
    'uses'=>'gererVisiteursController@sauvegarderModifier'
]);
Route::get('supprimerVisiteur/{id}',[
    'as'=>'supprimerVisiteurs',
    'uses'=>'gererVisiteursController@supprimerVisiteur'
]);
Route::get('ajouterVisiteur',[
    'as'=>'ajouterVisiteurs',
    'uses'=>'gererVisiteursController@ajouterVisiteur'
]);
Route::post('confirmAjouterVisiteur',[
    'as'=>'sendVisiteurs',
    'uses'=>'gererVisiteursController@confirmajouterVisiteur'
]);
Route::get('genererpdf',[
        'as'=>'genererPDF',
        'uses'=>'PDFController@genererPDF'
    ]);
Route::get('selectionAnnee',[
        'as'=>'chemin_selectionAnnee',
        'uses'=>'etatFraisController@selectionnerAnnee'
]);
Route::post('listeFraisAnnee',[
        'as'=>'chemin_listeFraisAnnee',
        'uses'=>'etatFraisController@voirFraisAnnee'
]);
Route::get('selectionVisiteur',[
        'as'=>'chemin_selectionVisiteur',
        'uses'=>'etatFraisController@selectionnerVisiteur'
]);
Route::post('listeFraisVisiteur',[
        'as'=>'chemin_listeFraisVisiteur',
        'uses'=>'etatFraisController@voirFraisVisiteur'
]);
Route::get('selectionTypeFrais',[
        'as'=>'chemin_selectionTypeFrais',
        'uses'=>'etatFraisController@selectionnerTypeFrais'
]);
Route::post('listeFraisType',[
        'as'=>'chemin_listeFraisType',
        'uses'=>'etatFraisController@voirFraisType'
]);
Route::post('genererTypeFraisXML',[
        'as'=>'genererTypeFraisXML',
        'uses'=>'etatFraisController@genererTypeFraisXML'
]);
Route::post('genererAnneeFraisXML',[
        'as'=>'genererAnneeFraisXML',
        'uses'=>'etatFraisController@genererAnneeFraisXML'
]);
Route::post('genererVisiteurFraisXML',[
        'as'=>'genererVisiteurFraisXML',
        'uses'=>'etatFraisController@genererVisiteurFraisXML'
]);

Route::get('validationfrais',[
    'as'=>'chemin_validationFrais',
    'uses'=>'gererFraisController@validerFrais'
]);

Route::post('getfrais',[
    'as'=>'chemin_getFrais',
    'uses'=>'gererFraisController@getFrais'
]);

Route::post('confirmerFrais',[
    'as'=>'chemin_confirmerFrais',
    'uses'=>'gererFraisController@confirmerFrais'
]);





