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


    public function insertNewCommande(Request $request)
    {
        dd($request);
        $resp="I RECIEVED UR REQ";
        return response()->json($resp);
    }



    public function ajax($id){

        $resp = DB::table('concerne')->select('Reference','designation','Libelle','prix_unitaire','qte_cmnd','date_effectue')
                                     ->join('produit','produit.code_produit','=','concerne.code_produit')
                                     ->join('categorie','produit.code_categorie','=','categorie.code_categorie')
                                     ->join('commande','commande.Numero_cmnd','=','concerne.Numero_cmnd')
                                     ->where('commande.numero_cmnd',$id)
                                     ->get();
        return response()->json($resp);
    
}



    public function products()
    {
          $products = DB::table('produit')->select('prix_unitaire')->orderByRaw('designation ASC')->get();
        return response()->json($products);
    }

    public function index()
    {   
        $user = Auth::user();

        $commandes = DB::table('commande')->whereId_client($user->id)
                        ->leftJoin('etat_commande', 'etat_commande.id_etat', '=', 'commande.id_etat')
                        ->leftJoin('users', 'users.id', '=', 'commande.id_admin')
                        ->orderByRaw('commande.date_effectue DESC')
                        ->get();
        $products = DB::table('produit')->orderByRaw('designation ASC')->get();
        /*dd($products);*/
        return view('home')->with([
                                    'commandes' => $commandes,
                                    'products' => $products
                                ]);
    }
}











