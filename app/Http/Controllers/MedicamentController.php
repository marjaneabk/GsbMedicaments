<?php

namespace App\Http\Controllers;

use App\dao\ServiceMedicament;
use Exception;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Exceptions\MonException;

class MedicamentController extends Controller
{
    public function getMedicaments()
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceMedicament = new ServiceMedicament();
            $mesMedicaments = $unServiceMedicament->getMedicaments();
            return view('vues/listeMedicaments', compact('mesMedicaments', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function addMedicament()
    {
        try {
            $erreur = "";
            $titrevue = "Ajout d'un Medicament";
            $unServiceMedicament = new ServiceMedicament();
            $mesMedicaments = $unServiceMedicament->getMedicaments();
            $familles = $unServiceMedicament->getFamillesMedicaments(); // Récupérer les familles de médicaments séparément
            return view('vues/formAjoutMedicament', compact('mesMedicaments', 'titrevue', 'erreur', 'familles'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }


    public function updateMedicament($id_medicament)
    {
        try {
            $monErreur = "";
            $erreur = "";
            $unServiceMedicament = new ServiceMedicament();
            $unMedicament = $unServiceMedicament->getById($id_medicament);
            $familles = $unServiceMedicament->getFamillesMedicaments(); // Récupérer les familles de médicaments séparément
            $titrevue = "Modification d'un médicament";
            return view('vues/formUpdateMedicament', compact('unMedicament', 'titrevue', 'erreur', 'familles'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validateMedicament()
    {
        try {
            $erreur = "";

            $id_medicament = Request::input('id_medicament');
            $id_famille = Request::input('id_famille');
            $depot_legal = Request::input('depot_legal');
            $nom_commercial = Request::input('nom_commercial');
            $effets = Request::input('effets');
            $contre_indication = Request::input('contre_indication');
            $prix_echantillon = Request::input('prix_echantillon');

            $unServiceMedicament = new ServiceMedicament();

            if ($id_medicament > 0) {
                $unServiceMedicament->updateMedicament($id_medicament, $id_famille, $depot_legal, $nom_commercial, $effets, $contre_indication, $prix_echantillon);
            } else {
                $unServiceMedicament->insertMedicament($id_famille, $depot_legal, $nom_commercial, $effets, $contre_indication, $prix_echantillon);
            }

            return redirect('/getListeMedicaments');
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function supprimeMedicament($id_medicament)
    {
        try {
            $erreur = "";
            $unServiceMedicament = new ServiceMedicament();
            $unServiceMedicament->deleteMedicament($id_medicament);
            $unServiceMedicament = new ServiceMedicament();
            $mesMedicaments = $unServiceMedicament->getMedicaments();
            return view('vues/getListeMedicaments', compact('mesMedicaments', 'erreur'));
        } catch (MonException $e) {
            return view('vues/getListeMedicaments', compact('mesMedicaments', 'erreur'));
        } catch (Exception $e) {
            return view('vues/listeMedicaments', compact('mesMedicaments', 'erreur'));
        }
    }




}
