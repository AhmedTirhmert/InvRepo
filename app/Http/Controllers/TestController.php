<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
Carbon::setLocale('fr');
class TestController extends Controller
{





    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function Dashboard()
    {

            $admins = DB::table('users')->whereId_type(1)->get();
            $clients = DB::table('users')->whereId_type(2)->get();
            $years = DB::select('SELECT DISTINCT YEAR(date_effectue) AS year FROM commande ORDER BY year DESC');
            $fournisseurs = DB::table('fournisseur')->get();
            $products = DB::table('produit')->select('code_produit','Reference','designation','quantite','libelle','prix_unitaire','name')
                                                    ->join('categorie','categorie.Code_categorie','=','produit.Code_categorie')
                                                    ->join('fournisseur','fournisseur.code_fournisseur','=','produit.code_fournisseur')
                                                    ->get();
            $commandes = DB::table('commande')->whereId_etat(2)
                                              ->join('users','users.id','=','commande.id_client')
                                              ->select('numero_cmnd','name','date_effectue') 
                                              ->orderByRaw('date_effectue DESC')
                                              ->get();   
            $categories = DB::table('categorie')->get();                                                                                     
            return view('Dashboard')->with([
                                            'admins' => $admins , 
                                            'clients'  => $clients,
                                            'fournisseurs' => $fournisseurs,
                                            'products' => $products,
                                            'commandes' => $commandes,
                                            'categories' => $categories,
                                            'years'=>$years
                                            ]);       
    }



   	public function User_Existence($name,$email)
    {
        $email_existe = DB::table('users')->select('id')->where('email',$email)->get();
        $name_existe = DB::table('users')->select('id')->where('name',$name)->get();


            if ((count($name_existe) != 0)) {
                return response()->json(['response'=>false,'Message'=>"nom déjà existe"]);
            }elseif (count($email_existe) != 0) {
                return response()->json(['response'=>false,'Message'=>"email déjà existe"]);
            }else{
                return response()->json(['response'=>true,'Message'=>"continue"]);
            }
    }


    function get_user_info($id)
    {
        $client_info = DB::table('users')->select('name','email','password')->where('id' , '=' , $id)->get();
                                                     
        return response()->json($client_info);
    }




    public function insertNewUser(Request $request)
    {

        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        if ($request->type == "client") {
                    DB::table('users')->insert(
                                                        [   'name' => $name, 
                                                            'email' => $email, 
                                                            'password' => Hash::make($password), 
                                                            'id_type' => 2, 
                                                        ]
                                                        );
                    return response()->json("La personne a été inséré avec succès");
        }else{
             DB::table('users')->insert(
                                            [   'name' => $name,
                                                'email' => $email,
                                                'password' => Hash::make($password),
                                                'id_type' => 1,
                                            ]
                                            );
                    return response()->json("L'admin a été inséré avec succès");
        }
    }


    function update_user(Request $request)
    {

        $email_existe = DB::table('users')->whereEmail($request->email)->get();
        $name_existe = DB::table('users')->wherename($request->name)->get();
        $user_info = DB::table('users')->whereid($request->id)->get();
        if ((count($email_existe) == 0) && (count($name_existe) == 0)) {
                DB::table('users')->where('id',$request->id)->update([
                                                                        'name' => $request->name,
                                                                        'email' => $request->email,
                                                                        'password' => Hash::make($request->password),
                                                                        ]);
                return response()->json(['response'=>true,'Message'=>"user info modifié avec succès"]);

        }elseif (($user_info[0]->email == $request->email) || ($user_info[0]->name == $request->name)) {
                if ($user_info[0]->email == $request->email) {
                    if ((count($name_existe) != 0) && ($name_existe[0]->name != $user_info[0]->name)) {
                        return response()->json(['response'=>false,'Message'=>"le nom d'utilisateur que vous avez entré déjà existe"]);
                    }else{
                        DB::table('users')->where('id',$request->id)->update(['password' => Hash::make($request->password),'name'=>$request->name]);
                        return response()->json(['response'=>true,'Message'=>"user info modifié avec succès"]);
                    }    
                }elseif ($user_info[0]->name == $request->name) {
                    if ((count($email_existe) != 0) && ($email_existe[0]->email != $user_info[0]->email)) {
                        return response()->json(['response'=>false,'Message'=>"l'email d'utilisateur que vous avez entré déjà existe"]);
                    }else{
                        DB::table('users')->where('id',$request->id)->update(['password' => Hash::make($request->password),'email'=>$request->email]);  
                        return response()->json(['response'=>true,'Message'=>"user infos successfully"]);
                    }    
                }else{
                        DB::table('users')->where('id',$request->id)->update(['password' => Hash::make($request->password)]);  
                        return response()->json(['response'=>true,'Message'=>"user infos successfully"]);
                }
        }else{

                return response()->json(['response'=>false,'Message'=>"Ces Infos que vous avez entré déjà existe"]);
        }
    }



    public function Fournisseur_Existence($name,$email,$telephone)
    {
        $email_existe = DB::table('fournisseur')->where('email',$email)->get();
        $name_existe = DB::table('fournisseur')->where('name',$name)->get();
        $telephone_existe = DB::table('fournisseur')->where('telephone',$telephone)->get();


            if ((count($name_existe) != 0)) {
                return response()->json(['response'=>false,'Message'=>"nom déjà existe"]);
            }elseif (count($email_existe) != 0) {
                return response()->json(['response'=>false,'Message'=>"email déjà existe"]);
            }elseif (count($telephone_existe) != 0) {
                return response()->json(['response'=>false,'Message'=>"telephone déjà existe"]);
            }else{
                return response()->json(['response'=>true,'Message'=>"continue"]);
            }

                  
    }

    public function insertNewFournisseur(Request $request)
    {

         DB::table('fournisseur')->insert(
                                    [   
                                        'name' => $request->name,
                                        'email' => $request->email,
                                        'telephone' => $request->telephone,
                                        'adresse' => $request->adresse,
                                    ]
                                    );
                    return response()->json("Ce fournisseur a été inséré avec succès");

    }


    function get_fournisseur_info($Code_fournisseur)
    {
        $fournisseur_info = DB::table('fournisseur')->select('name','email','adresse','telephone')->where('Code_fournisseur' , '=' , $Code_fournisseur)->get();
                                                     
        return response()->json($fournisseur_info);

    }

    function update_Fournisseur(Request $request)
    {
        //data exestience 
        $email_existe = DB::table('fournisseur')->whereEmail($request->email)->get();
        $name_existe = DB::table('fournisseur')->wherename($request->name)->get();
        $telephone_existe = DB::table('fournisseur')->wherename($request->telephone)->get();
        //actual fournisseur data
        $fournisseur_info = DB::table('fournisseur')->whereCode_fournisseur($request->Code_fournisseur)->get();
        if ( (count($email_existe) == 0) &&  (count($name_existe) == 0) &&  (count($telephone_existe) == 0) ) 
        {
                DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update([
                                                                                                        'name' => $request->name,
                                                                                                        'email' => $request->email,
                                                                                                        'telephone' => $request->telephone,
                                                                                                        'adresse' => $request->adresse,
                                                                                                        ]);
                            if ($fournisseur_info[0]->adresse == $request->adresse) {
                                return response()->json(['response'=>true,'Message'=>"fournisseur data (nom email telephone) modifié avec succès"]);           
                            }else {
                                return response()->json(['response'=>true,'Message'=>"fournisseur data (nom email telephone adresse) modifié avec succès"]);
                            }
        }elseif (($fournisseur_info[0]->email == $request->email) && ($fournisseur_info[0]->name == $request->name) && ($fournisseur_info[0]->telephone == $request->telephone)){
                            if ($fournisseur_info[0]->adresse == $request->adresse) {
                                return response()->json(['response'=>true,'Message'=>"Rien a modifié !! ^_^"]);         
                            }else {
                                DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update(['adresse' => $request->adresse]);  
                                return response()->json(['response'=>true,'Message'=>"L'adresse a été modifié avec succès "]);                              
                            }                                
        }elseif (($fournisseur_info[0]->email == $request->email) || ($fournisseur_info[0]->name == $request->name) || ($fournisseur_info[0]->telephone == $request->telephone)) {

                if (($fournisseur_info[0]->email == $request->email) && ($fournisseur_info[0]->name == $request->name)) {
                    if ((count($telephone_existe) != 0) && ($name_existe[0]->telephone != $fournisseur_info[0]->telephone)) {
                            return response()->json(['response'=>false,'Message'=>"Le télephone que vous avez entré déjà existe"]);
                    }else{
                            DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update([
                                                                                                                    'telephone' => $request->telephone,
                                                                                                                    'adresse' => $request->adresse,
                                                                                                                         ]);

                            if ($fournisseur_info[0]->adresse == $request->adresse) {
                                return response()->json(['response'=>true,'Message'=>"Le télephone a été modifié avec succès"]);           
                            }else {
                                return response()->json(['response'=>true,'Message'=>"Le télephone et l'adresse du fournisseur aont été modifié avec succès"]);
                            }                     
                    }
                }elseif (($fournisseur_info[0]->name == $request->name) && ($fournisseur_info[0]->telephone == $request->telephone)) {
                    if ((count($email_existe) != 0) && ($email_existe[0]->email != $fournisseur_info[0]->email)) {
                            return response()->json(['response'=>false,'Message'=>"L'email que vous avez entré déjà existe"]);
                    }else{
                            DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update([
                                                                                                                    'email' => $request->email,
                                                                                                                    'adresse' => $request->adresse,
                                                                                                                         ]);

                           if ($fournisseur_info[0]->adresse == $request->adresse) {
                                return response()->json(['response'=>true,'Message'=>"L'email du fournisseur a été modifié avec succès"]);           
                            }else {
                                return response()->json(['response'=>true,'Message'=>"L'email et l'adresse ont été modifié avec succès"]);
                            }                       
                    }               
                }elseif (($fournisseur_info[0]->email == $request->email) && ($fournisseur_info[0]->telephone == $request->telephone)) {
                    if ((count($name_existe) != 0) && ($email_existe[0]->name != $fournisseur_info[0]->name)) {
                            return response()->json(['response'=>false,'Message'=>"Le nom que vous avez entré déjà existe "]);
                    }else{
                            DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update([
                                                                                                                    'name' => $request->name,
                                                                                                                    'adresse' => $request->adresse,
                                                                                                                         ]);
                            if ($fournisseur_info[0]->adresse == $request->adresse) {
                                return response()->json(['response'=>true,'Message'=>"Le nom est modifé avec succès "]);           
                            }else {
                                return response()->json(['response'=>true,'Message'=>"Le nom et l'adresse sont modifié avec succès"]);
                            }
                    }                     
                }elseif ($fournisseur_info[0]->email == $request->email) {
                    if ((count($name_existe) != 0) && ($name_existe[0]->name != $fournisseur_info[0]->name)) {
                                return response()->json(['response'=>false,'Message'=>"Le nom du fournisseur que vous avez entré est déjà existe"]);
                    }elseif ((count($telephone_existe) != 0) && ($name_existe[0]->telephone != $fournisseur_info[0]->telephone)) {
                                return response()->json(['response'=>false,'Message'=>"Le télephone que vous avez entré est déjà existe"]);
                    }else{
                            DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update([
                                                                                                                    'name' => $request->name,
                                                                                                                    'telephone' => $request->telephone,
                                                                                                                    'adresse' => $request->adresse,
                                                                                                                     ]);


                           if ($fournisseur_info[0]->adresse == $request->adresse) {
                                return response()->json(['response'=>true,'Message'=>"Le nom et le télephone sont modifié avec succès"]);           
                            }else {
                                return response()->json(['response'=>true,'Message'=>"Le nom et télephone et l'adresse sont modifié avec succès"]);
                            }  
                    }    
                }elseif ($fournisseur_info[0]->name == $request->name) {
                            if ((count($email_existe) != 0) && ($email_existe[0]->email != $fournisseur_info[0]->email)) {
                                        return response()->json(['response'=>false,'Message'=>"L'email que vous avez entré est déjà existe"]);
                            }elseif ((count($telephone_existe) != 0) && ($telephone_existe[0]->telephone != $fournisseur_info[0]->telephone)) {
                                        return response()->json(['response'=>false,'Message'=>"Le télephonel que vous avez entré est déjà existe"]);
                            }else{
                                    DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update([
                                                                                                                            'email' => $request->email,
                                                                                                                            'telephone' => $request->telephone,
                                                                                                                            'adresse' => $request->adresse,
                                                                                                                             ]);            
                                   if ($fournisseur_info[0]->adresse == $request->adresse) {
                                        return response()->json(['response'=>true,'Message'=>"L'email et le télephone sont modifié avec succès"]);           
                                    }else {
                                        return response()->json(['response'=>true,'Message'=>"L'email,télephone et adresse sont modifié avec succès"]);
                                    }  
                            }    
                }elseif ($fournisseur_info[0]->telephone == $request->telephone) {
                            if ((count($name_existe) != 0) && ($name_existe[0]->name != $fournisseur_info[0]->name)) {
                                        return response()->json(['response'=>false,'Message'=>"Le nom que vous avez entré est déjà existe"]);
                            }elseif ((count($email_existe) != 0) && ($email_existe[0]->email != $fournisseur_info[0]->email)) {
                                        return response()->json(['response'=>false,'Message'=>"L'email que vous avez entré est déjà existe"]);
                            }else{
                                    DB::table('fournisseur')->where('Code_fournisseur',$request->Code_fournisseur)->update([
                                                                                                                            'name' => $request->name,
                                                                                                                            'email' => $request->telephone,
                                                                                                                            'adresse' => $request->adresse,
                                                                                                                             ]);

                                   if ($fournisseur_info[0]->adresse == $request->adresse) {
                                        return response()->json(['response'=>true,'Message'=>"Le nom et l'email du fournisseur sont modifié avec succès "]);           
                                    }else {
                                        return response()->json(['response'=>true,'Message'=>"Le nom,l'email et l'adresse du fournisseur sont modifié avec succès"]);
                                    }
                            }  
                }
        }else{
                return response()->json(['response'=>false,'Message'=>"Ces infos que vous avez entré sont déjà existe"]);
        }
    }



    public function Produit_Existence($Reference)
    {

            $produit_existe = DB::table('produit')->where('Reference',$Reference)->get();
                if (strlen($Reference) < 8) {
                    return response()->json(['response'=>false,'Message'=>"La longueur de référence est inférieure à 8 caractères"]);
                }elseif (strlen($Reference) > 8) {
                    return response()->json(['response'=>false,'Message'=>"La longueur de référence est supérieure à 8 caractères"]);
                }
                if ((count($produit_existe) != 0)) {
                    return response()->json(['response'=>false,'Message'=>"Référence déjà existe"]);
                }else{
                    return response()->json(['response'=>true,'Message'=>"Continue"]);
                }    
    }

    public function insertNewProduit(Request $request)
    {

         DB::table('produit')->insert(
                                    [   
                                        'reference' => $request->reference,
                                        'designation' => $request->designation,
                                        'code_categorie' => $request->code_categorie,
                                        'prix_unitaire' => $request->prix_unitaire,
                                        'quantite' => $request->quantite,
                                        'code_fournisseur' => $request->code_fournisseur,
                                    ]
                                    );
                    return response()->json("Ce produit est inséré avec succès");
    }


    public function get_Produit_info($Code_produit)
    {

        $product_info = DB::table('produit')->whereCode_produit($Code_produit)->get();
        return response()->json($product_info);
    }

    public function update_Produit(Request $request)
    {

        if (strlen($request->refference) < 8) {
            return response()->json(['response'=>false,'Message'=>"La longueur de référence est inférieure à 8 caractères"]);
        }elseif (strlen($request->refference) > 8) {
            return response()->json(['response'=>false,'Message'=>"La longueur de référence est supérieure à 8 caractères"]);
        }    

        $Refferance_existe = DB::table('produit')->whereReference($request->refference)->get();
        $product_info = DB::table('produit')->whereCode_produit($request->code_produit)->get();

        if (($product_info[0]->Reference == $request->refference) 
        &&  ($product_info[0]->designation == $request->designation)
        &&  ($product_info[0]->prix_unitaire == $request->prix_unitaire)
        &&  ($product_info[0]->code_fournisseur == $request->code_fournisseur)
        &&  ($product_info[0]->code_categorie == $request->code_categorie)
        &&  ($product_info[0]->quantite == $request->quantite)) 
            {
                return response()->json(['response'=>true,'Message'=>"Rien a modifié !! ^_^"]); 
            }
        if ((count($Refferance_existe) == 0) ) {

                   

                DB::table('produit')->where('code_produit',$request->code_produit)->update([
                                                                                            'reference' => $request->reference,
                                                                                            'designation' => $request->designation,
                                                                                            'prix_unitaire' => $request->prix_unitaire,
                                                                                            'quantite' => $request->quantite,
                                                                                            'code_categorie' => $request->code_categorie,
                                                                                            'code_fournisseur' => $request->code_fournisseur,
                                                                                            ]);
                
                    return response()->json(['response'=>true,'Message'=>"product info updated successfully"]);
                }elseif ((count($Refferance_existe) != 0) && $product_info[0]->Reference == $request->refference) {
                DB::table('produit')->where('code_produit',$request->code_produit)->update([
                                                                                            'designation' => $request->designation,
                                                                                            'prix_unitaire' => $request->prix_unitaire,
                                                                                            'quantite' => $request->quantite,
                                                                                            'code_categorie' => $request->code_categorie,
                                                                                            'code_fournisseur' => $request->code_fournisseur,
                                                                                            ]);
                    return response()->json(['response'=>true,'Message'=>"Produit modifié avec succès "]);
                

        }else{

                return response()->json(['response'=>false,'Message'=>"La référence que vous avez entré est déjà existe"]);
        }
    }


    public function cmnd_approval($numero_cmnd)
    {
        try {
                $cmnd = DB::table('commande')->select('id_admin')->where('numero_cmnd',$numero_cmnd)->get();
                if (!(is_null($cmnd[0]->id_admin))) {
                   return response()->json(['response'=>false,'approved'=>true,'Message'=>"Cette commande est déjà approuvé par un admin"]); 
                }
                $insufisant_products = array();
                $quantites_cmnd = DB::table('concerne')->select('qte_cmnd')->where('numero_cmnd',$numero_cmnd)->get();
                $quantites = DB::table('concerne')->select('quantite')
                                                    ->join('produit','produit.code_produit','=','concerne.code_produit')
                                                    ->where('numero_cmnd',$numero_cmnd)
                                                    ->get(); 
                $products_names = DB::table('concerne')->select('designation')
                                                    ->join('produit','produit.code_produit','=','concerne.code_produit')
                                                    ->where('numero_cmnd',$numero_cmnd)
                                                    ->get();                                                                                              

                for ($i=0; $i < count($quantites_cmnd); $i++) { 
                 
                    if (($quantites[$i]->quantite - $quantites_cmnd[$i]->qte_cmnd) < 0) {
                       $insufisant_products[count($insufisant_products)] = $products_names[$i]->designation;
                    }
                }
                    if (count($insufisant_products)!=0) {
                        return response()->json(['response'=>false,'approved'=>false,'products'=>$insufisant_products]);
                    }else{
                        return response()->json(['response'=>true]);                                                
                    }
        } catch (Exception $e) {return response()->json(['response'=>false,'Message'=> $e.getMessage()]); }
            
      
     
               

    }

               
    public function cmnd_approved(Request $request)
    {
        try {
            $cmnd = DB::table('commande')->select('id_admin')->where('numero_cmnd',$request->numero_cmnd)->get();
            if (!(is_null($cmnd[0]->id_admin))) {
               return response()->json(['response'=>false,'approved'=>true,'Message'=>"Cette commande est déjà approuvé par un admin"]); 
            }
            $quantites_cmnd = DB::table('concerne')->select('code_produit','qte_cmnd')->where('numero_cmnd',$request->numero_cmnd)->orderByRaw('code_produit ASC')->get();
            $quantites = DB::table('concerne')->select('quantite')
                                                ->join('produit','produit.code_produit','=','concerne.code_produit')
                                                ->where('numero_cmnd',$request->numero_cmnd)
                                                ->orderByRaw('concerne.code_produit ASC')
                                                ->get(); 
            $qte_rests = array();                                                
            for ($i=0; $i < count($quantites_cmnd); $i++) 
            {
                DB::table('produit')->where('code_produit',$quantites_cmnd[$i]->code_produit)->update(['quantite' => $quantites[$i]->quantite-$quantites_cmnd[$i]->qte_cmnd]);
            }  
                DB::table('commande')->where('numero_cmnd',$request->numero_cmnd)->update(['id_etat' => 1,'id_admin'=> $request->id_admin]);   

        } catch (Exception $e) {

            return response()->json(['response'=>false,'Message'=> $e.getMessage()]); 
        }

            return response()->json(['response'=>true,'approved'=>true,'Message'=>"Cette commande est approuvé avec succès"]); 
                                    

    }    




    public function commandes_filter($annee,$etat)  
    {
        $periods = array(); 
        if (($annee != "Tout")&&($etat != "Tout")) {
            $commandes = DB::select('SELECT * FROM commande JOIN users ON users.id=commande.id_client WHERE YEAR(date_effectue)='.$annee.' AND id_etat='.$etat.' ORDER BY date_effectue DESC');
            for ($i=0; $i < count($commandes); $i++) {
                $periods[count($periods)]=Carbon::now()->subDays(Carbon::parse($commandes[$i]->date_effectue)->diffInDays(Carbon::now()))->diffForHumans();
            }            
        }elseif (($annee == "Tout")&&($etat != "Tout")) {
            $commandes = DB::table('commande')->whereId_etat($etat)->join('users','users.id','=','commande.id_client')->orderByRaw('date_effectue DESC')->get();
            for ($i=0; $i < count($commandes); $i++) {
                $periods[count($periods)]=Carbon::now()->subDays(Carbon::parse($commandes[$i]->date_effectue)->diffInDays(Carbon::now()))->diffForHumans();
            }
        }elseif (($annee != "Tout")&&($etat == "Tout")) {
            $commandes = DB::select('SELECT * FROM commande JOIN users ON users.id=commande.id_client WHERE YEAR(date_effectue)='.$annee.' ORDER BY date_effectue DESC');
            for ($i=0; $i < count($commandes); $i++) {
                $periods[count($periods)]=Carbon::now()->subDays(Carbon::parse($commandes[$i]->date_effectue)->diffInDays(Carbon::now()))->diffForHumans();
            }            
        }else{
            $commandes = DB::table('commande')->join('users','users.id','=','commande.id_client')->orderByRaw('date_effectue DESC')->get();
            for ($i=0; $i < count($commandes); $i++) {
                $periods[count($periods)]=Carbon::now()->subDays(Carbon::parse($commandes[$i]->date_effectue)->diffInDays(Carbon::now()))->diffForHumans();
            }        
        }
        return response()->json(['commandes'=>$commandes ,'periods'=>$periods]);
    }  



    public function statistics($top10year,$top)  
    {
        if ($top == 'FOURNISSEURS') {
            if ($top10year == 'Tout') {
                $resualt = DB::select('SELECT name,sum(concerne.qte_cmnd * produit.prix_unitaire) prix
                                            from concerne
                                            inner join produit
                                            on produit.code_produit = concerne.code_produit
                                            inner join fournisseur 
                                            on fournisseur.code_fournisseur=produit.code_fournisseur
                                            inner join commande 
                                            on commande.numero_cmnd = concerne.numero_cmnd
                                            AND commande.id_etat = 1
                                            GROUP BY name
                                            order by prix desc');
            }else{
                $resualt = DB::select('SELECT  name,sum(concerne.qte_cmnd * produit.prix_unitaire) prix
                                            from concerne
                                            inner join produit
                                            on produit.code_produit = concerne.code_produit
                                            inner join fournisseur 
                                            on fournisseur.code_fournisseur=produit.code_fournisseur
                                            inner join commande 
                                            on commande.numero_cmnd = concerne.numero_cmnd
                                            where YEAR(commande.date_effectue) = '.$top10year.'
                                            AND commande.id_etat = 1
                                            GROUP BY name
                                            order by prix desc');
            }
        }elseif ($top == 'CLIENTS') {
            if ($top10year == 'Tout') {
                $resualt = DB::select('SELECT name , email , sum(concerne.qte_cmnd) nbr_qty
                                            from concerne
                                            inner join commande 
                                            on commande.numero_cmnd = concerne.numero_cmnd
                                            inner join users
                                            on users.id = commande.id_client
                                            AND commande.id_etat = 1
                                            GROUP BY name,email
                                            order by nbr_qty desc
                                            ');               
            }else{
                $resualt = DB::select('SELECT name , email , sum(concerne.qte_cmnd) nbr_qty
                                            from concerne
                                            inner join commande 
                                            on commande.numero_cmnd = concerne.numero_cmnd
                                            inner join users
                                            on users.id = commande.id_client
                                            where YEAR(commande.date_effectue) = '.$top10year.'
                                            AND commande.id_etat = 1
                                            GROUP BY name,email
                                            order by nbr_qty desc
                                            ');
            }
        }elseif ($top == 'PRODUITS') {
            if ($top10year == 'Tout') {
                $resualt = DB::select('SELECT designation , REFERENCE ,concerne.code_produit, SUM(concerne.qte_cmnd) qty_total
                                            from concerne
                                            inner join produit
                                            on produit.code_produit = concerne.code_produit
                                            inner join commande 
                                            on commande.numero_cmnd = concerne.numero_cmnd
                                            where id_etat = 1
                                            GROUP BY designation , REFERENCE ,concerne.code_produit 
                                            order by qty_total desc
                                            ');
            }else{
                $resualt = DB::select('SELECT designation , REFERENCE ,concerne.code_produit, SUM(concerne.qte_cmnd) qty_total
                                            from concerne
                                            inner join produit
                                            on produit.code_produit = concerne.code_produit
                                            inner join commande 
                                            on commande.numero_cmnd = concerne.numero_cmnd
                                            where YEAR(commande.date_effectue) = '.$top10year.'
                                            AND id_etat = 1
                                            GROUP BY designation , REFERENCE ,concerne.code_produit 
                                            order by qty_total desc
                                            ');
            }
        }elseif ($top == 'CATEGORIE') {
            if ($top10year == 'Tout') {
                $resualt = DB::select('SELECT libelle ,count(concerne.numero_cmnd) nbr_cmnd , sum(concerne.qte_cmnd) nbr_qte
                                            from concerne 
                                            inner join produit on produit.code_produit = concerne.code_produit
                                            inner join categorie on categorie.code_categorie = produit.code_categorie
                                            inner join commande on commande.numero_cmnd=concerne.numero_cmnd
                                            group by libelle
                                            order by nbr_qte desc
                                            ');                
            }else{
                $resualt = DB::select('SELECT libelle ,count(concerne.numero_cmnd) nbr_cmnd , sum(concerne.qte_cmnd) nbr_qte
                                            from concerne 
                                            inner join produit on produit.code_produit = concerne.code_produit
                                            inner join categorie on categorie.code_categorie = produit.code_categorie
                                            inner join commande on commande.numero_cmnd=concerne.numero_cmnd
                                            where YEAR(commande.date_effectue) = '.$top10year.'
                                            group by libelle
                                            order by nbr_qte desc
                                            ');
            }
        }

        return response()->json(['statistics_OF'=>$top,'statistics'=>$resualt]);
    }

































}
