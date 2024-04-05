<?php

namespace App\Http\Controllers;

use App\dao\ServiceMedicament;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Exceptions\MonException;
use App\Models\Medicament;
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
            $mesMedicaments = Medicament::with('famille')->get();
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

    public function rechercheMedicament()
    {
        try {
            $erreur = "";
            $recherche = Request::input('recherche');
            $unServiceMedicament = new ServiceMedicament();
            $mesMedicaments = $unServiceMedicament->rechercheMedicament($recherche);
            return view('vues/listeMedicaments', compact('mesMedicaments', 'erreur'));
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



}
