<?php

namespace App\Http\Controllers;

use App\dao\ServiceVisiteur;
use App\Exceptions\MonException;
use Exception;
use Illuminate\Support\Facades\Session;
use Request;
use App\metier\Visiteur;
class VisiteurController extends Controller
{
    public function getLogin() {
        try {
            $erreur = "";
            return view ('vues.formLogin', compact('erreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues.formLogin', compact('erreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues.formLogin', compact('erreur'));
        }
    }

    public function signIn() {
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                if (Session::get('type') === 'P') {
                    return view('vues/connect');
                } else {
                    return view('vues/connect');
                }
            } else {
                $erreur = "Login ou mot de passe inconnu";
                return view('vues/formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/formLogin', compact('monErreur')); // au lieu de 'Vues/formLogin'
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/formLogin', compact('monErreur')); // au lieu de 'Vues/formLogin'
        }
    }

    public function signOut() {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }
}
