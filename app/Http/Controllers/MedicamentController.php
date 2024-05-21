<?php

namespace App\Http\Controllers;

use App\dao\ServiceMedicament;
use App\Models\Composant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exceptions\MonException;
use App\Models\Medicament;
class MedicamentController extends Controller
{
    public function getMedicaments(Request $request)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceMedicament = new ServiceMedicament();
            $mesMedicaments = $unServiceMedicament->getMedicaments($request->get('searchTerm'));
            foreach ($mesMedicaments as $medicament) {
                $medicament->contraindicatedDrugs = $unServiceMedicament->getContraindicatedDrugs($medicament->id_medicament);
            }

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

    public function validateMedicament(Request $request)
    {
        try {
            $erreur = "";

            $id_medicament = $request->input('id_medicament');
            $id_famille = $request->input('id_famille');
            $depot_legal = $request->input('depot_legal');
            $nom_commercial = $request->input('nom_commercial');
            $effets = $request->input('effets');
            $contre_indication = $request->input('contre_indication');
            $prix_echantillon = $request->input('prix_echantillon');

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
            $unServiceMedicament = new ServiceMedicament();
            $unServiceMedicament->deleteMedicament($id_medicament);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }

        try {
            $unServiceMedicament = new ServiceMedicament();
            $mesMedicaments = $unServiceMedicament->getMedicaments();
            return view('vues/listeMedicaments', compact('mesMedicaments'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }


    public function details($id)
    {
        try {
            $serviceMedicament = new ServiceMedicament();
            $medicament = $serviceMedicament->getById($id);
            $contraindicatedDrugs = $serviceMedicament->getContraindicatedDrugs($id);
            $allDrugs = $serviceMedicament->getMedicaments(); // Assuming you have a method to get all drugs
            return view('vues/detailsMedicaments', compact('medicament', 'contraindicatedDrugs', 'allDrugs'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }


    public function addInteraction(Request $request, $id_medicament)
    {
        try {
            $id_interaction = $request->input('id_interaction');
            $unServiceMedicament = new ServiceMedicament();
            $unServiceMedicament->addInteraction($id_medicament, $id_interaction);
            return redirect()->route('detailsMedicament', ['id' => $id_medicament]);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }


    public function deleteInteraction($id_medicament, $id_interaction)
    {
        try {
            $unServiceMedicament = new ServiceMedicament();
            $unServiceMedicament->deleteInteraction($id_medicament, $id_interaction);
            return redirect()->route('detailsMedicament', ['id' => $id_medicament]);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }



    public function modifierMedicamentCompatible(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_medicament' => 'required|integer',
            'old_med_id_medicament' => 'required|integer',
            'new_med_id_medicament' => 'required|integer',
        ]);

        $unServiceMedicament = new ServiceMedicament();

        // Find the contraindicated drug
        $oldMedicament = $unServiceMedicament->findMedicament($request->old_med_id_medicament);

        // Check if the contraindicated drug exists
        if (!$oldMedicament) {
            return redirect()->back()->with('error', 'Contrindicated drug not found');
        }

        // Find the new drug
        $newMedicament = $unServiceMedicament->findMedicament($request->new_med_id_medicament);

        // Check if the new drug exists
        if (!$newMedicament) {
            return redirect()->back()->with('error', 'New drug not found');
        }

        // Update the contraindicated drug
        $unServiceMedicament->updateContraindicatedDrug($oldMedicament, $newMedicament, $request->id_medicament);

        // Redirect back with a success message
        return redirect()->route('detailsMedicament', ['id' => $request->id_medicament]);
    }



    public function getCompo(Request $request){
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceMedicament = new ServiceMedicament();
            $lesCompos = $unServiceMedicament->getCompo();
            return view('vues/listeComposants', compact('lesCompos', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function getComposant() {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceMedicament = new ServiceMedicament();
            $lesCompos = $unServiceMedicament->getComposant();
            return view('vues/listeCompos', compact('lesCompos', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }



    public function getComposantById(Request $request)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceMedicament = new ServiceMedicament();
            $lesCompos = $unServiceMedicament->getComposantById($request->get('id_composant'));
            return view('vues/detailsComposants', compact('lesCompos', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function rechercheComposant(Request $request)
    {
        $id_composant = $request->get('composant');
        $composant = Composant::where('id_composant', $id_composant)->first();
        return view('vues/listeCompos', compact('composant'));

    }

    public function updateCompos($id_composant)
    {
        try {
            $monErreur = "";
            $erreur = "";
            $unServiceMedicament = new ServiceMedicament();
            $unComposant = $unServiceMedicament->getComposantById($id_composant);
            $titrevue = "Modification d'un composant";
            return view('vues/modifCompos', compact('unComposant', 'titrevue', 'erreur'));

        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }


}
