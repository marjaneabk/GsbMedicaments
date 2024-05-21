<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Medicament;
class ServiceMedicament
{
    public function getMedicaments($searchTerm = null)
    {
        try {
            $query = Medicament::with('famille');

            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('nom_commercial', 'like', '%' . $searchTerm . '%');
                });
            }

            $mesMedicaments = $query->get();

            foreach ($mesMedicaments as $medicament) {
                $medicament->contraindicatedDrugs = $this->getContraindicatedDrugs($medicament->id_medicament);
            }

            return $mesMedicaments;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getFamillesMedicaments()
    {
        try {
            $lesFamilles = DB::table('famille')->select('id_famille', 'lib_famille')->get();
            return $lesFamilles;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


    public function getById($id_medicament)
    {
        try {
            $medicamentById = DB::table('medicament')
                ->select()
                ->where('id_medicament', '=', $id_medicament)
                ->first();

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
        return $medicamentById;
    }

    // ServiceMedicament class
    public function insertMedicament($id_famille, $depot_legal, $nom_commercial, $effets, $contre_indication, $prix_echantillon)
    {
        try {
            DB::table('medicament')->insert([
                'id_famille' => $id_famille,
                'depot_legal' => $depot_legal,
                'nom_commercial' => $nom_commercial,
                'effets' => $effets,
                'contre_indication' => $contre_indication,
                'prix_echantillon' => $prix_echantillon,
            ]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updateMedicament($id_medicament, $id_famille, $depot_legal, $nom_commercial, $effets, $contre_indication, $prix_echantillon)
    {
        try {
            DB::table('medicament')
                ->where('id_medicament', '=', $id_medicament)
                ->update(['id_famille' => $id_famille,
                    'depot_legal' => $depot_legal,
                    'nom_commercial' => $nom_commercial,
                    'effets' => $effets,
                    'contre_indication' => $contre_indication,
                    'prix_echantillon' => $prix_echantillon
                ]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

    public function deleteMedicament($id_medicament)
    {
        try {
            DB::table('medicament')->where('id_medicament', '=', $id_medicament)->delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }




    public function getContraindicatedDrugs($drug_id)
    {
        $contraindicatedDrugs = DB::table('interagir')
            ->join('medicament', 'interagir.med_id_medicament', '=', 'medicament.id_medicament')
            ->where('interagir.id_medicament', $drug_id)
            ->get();

        return $contraindicatedDrugs;
    }

    public function addInteraction($id_medicament, $id_interaction)
    {
        try {
            DB::table('interagir')->insert([
                'id_medicament' => $id_medicament,
                'med_id_medicament' => $id_interaction
            ]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


    public function deleteInteraction($id_medicament, $id_interaction)
    {
        try {
            DB::table('interagir')
                ->where('id_medicament', $id_medicament)
                ->where('med_id_medicament', $id_interaction)
                ->delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function findMedicament($id)
    {
        return Medicament::find($id);
    }

    public function updateContraindicatedDrug($oldMedicament, $newMedicament, $id_medicament)
    {
        // Delete the old contraindicated drug
        DB::table('interagir')
            ->where('id_medicament', $id_medicament)
            ->where('med_id_medicament', $oldMedicament->id_medicament)
            ->delete();

        // Add the new contraindicated drug
        DB::table('interagir')->insert([
            'id_medicament' => $id_medicament,
            'med_id_medicament' => $newMedicament->id_medicament
        ]);
    }



}
