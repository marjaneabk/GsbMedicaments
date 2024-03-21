<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceMedicament
{
    public function getMedicaments()
    {
        try {
            $lesMedicaments = DB::table('medicament')
                ->select()
                ->get();
            return $lesMedicaments;
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


    public function getById($id_medicament){
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

    public function updateMedicament($id_medicament,$id_famille, $depot_legal, $nom_commercial, $effets, $contre_indication, $prix_echantillon)
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

    public function deleteMedicament($id_medicament){
        try {
            DB::table('medicament')->where('id_medicament', '=', $id_medicament)->delete();
        }catch (QueryException $e){
            throw new MonException($e->getMessage(), 5);
        }



    }


}
