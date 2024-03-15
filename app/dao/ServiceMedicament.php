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

}
