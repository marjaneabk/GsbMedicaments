<?php

namespace App\Http\Controllers;

use App\dao\ServiceMedicament;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Exceptions;
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

}
