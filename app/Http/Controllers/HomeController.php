<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();

        $commandes = DB::table('commande')->whereId_client($user->id)
                        ->leftJoin('etat_commande', 'etat_commande.id_etat', '=', 'commande.id_etat')
                        ->leftJoin('users', 'users.id', '=', 'commande.id_admin')
                        ->orderByRaw('commande.date_effectue DESC')
                        ->get();
        
        return view('home')->with([
                                    'commandes' => $commandes
                                ]);
    }
}
