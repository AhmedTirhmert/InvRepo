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


   public function insertNewCommande(Request $request){

        $date_effectue = $request->date_effectue;
        $client_ID = $request->client_ID;
        $count = count($request->products);
        try {
            $cmnd_id =  DB::table('commande')->insertGetId(
                                                [
                                                    'id_client' => $client_ID,
                                                    'date_effectue' => $date_effectue 
                                                ]
                                                );
            foreach ($request->products as $element ) {
                        DB::table('concerne')->insert(
                                                [
                                                    'code_produit' => $element['Code_produit'],
                                                    'qte_cmnd' => $element['QUANTITE'],
                                                    'numero_cmnd' => $cmnd_id   
                                                ]
                                                );
            }
        } catch (Exception $e) {
            return response()->json('ERROR MESSAGE : ' .$e->getMessage());
        }

        return response()->json("Votre commande est terminée en attendant que l'administrateur l'approuver !"); 
   }

    public function cmnd_dtl($id){

        $products = DB::table('concerne')->select('Reference','designation','Libelle','prix_unitaire','qte_cmnd','quantite','date_effectue','name')
                                     ->join('produit','produit.code_produit','=','concerne.code_produit')
                                     ->join('categorie','produit.code_categorie','=','categorie.code_categorie')
                                     ->join('commande','commande.Numero_cmnd','=','concerne.Numero_cmnd')
                                     ->join('users','commande.id_client','=','users.id')
                                     ->where('commande.numero_cmnd',$id)
                                     ->get();

        $infos = DB::table('commande')->select('name','Message','id_etat')
                                     ->leftjoin('users','commande.id_admin','=','users.id')
                                     ->where('commande.numero_cmnd',$id)
                                     ->get();




                                                                                                               
        return response()->json(['products'=>$products,'infos'=>$infos]);
    
    }





    public function home()
    {   
        $user = Auth::user();

        $commandes = DB::table('commande')->whereId_client($user->id)
                        ->leftJoin('etat_commande', 'etat_commande.id_etat', '=', 'commande.id_etat')
                        ->leftJoin('users', 'users.id', '=', 'commande.id_admin')
                        ->orderByRaw('commande.date_effectue DESC')
                        ->get();
        $products = DB::table('produit')->orderByRaw('designation ASC')->get();
        return view('home')->with([
                                    'commandes' => $commandes,
                                    'products' => $products
                                ]);
    }
    public function index()
    {
        return redirect('home');
    }













}











