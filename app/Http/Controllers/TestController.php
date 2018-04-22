<?php

namespace App\Http\Controllers;
use DB;
use App\admin;

use Illuminate\Http\Request;

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
        $fournisseurs = DB::table('fournisseur')->take(6)->get();
        return view('Dashboard')->with([
                                        'admins' => $admins , 
                                        'clients'  => $clients,
                                        'fournisseurs' => $fournisseurs
                                        ]);       
    }





    public function contact(){
        //echo"Hello From contact function inside controller ";

        /*$admins = DB::table('Admins')->get();
        echo "<li>".$admins->name."</li>";*/

        $admins = DB::table('Admins')->get();
        foreach ($admins as $elem ) {
        	echo "<li>".$elem->name."</li>";
        }
        
    }
    public function insertAdmin()
    {
    	DB::table('Admins')->insertGetId(
    		array(
    			'Name' => 'Rehma Maissou' ,
    			'email' => 'Rehma@gmail.com',
    			'password' => 'kvgdskvbq'
    	 		)
    	);
    	return 'insertion complete';



    	/*$id=DB::table('Admins')->insertGetId(
    		array(
    			'Name' => 'Ahmed Tirhmert' ,
    			'email' => 'Ahmed@gmail.com',
    			'password' => 'kvgdskvbq'
    	 		)
    	);
    	return 'insertion complete for id = '.$id;*/
    }

    public function selectadminsnames()
    {

    	$usersname=DB::select("SELECT name FROM Admins ORDER BY id_admin" );
    	foreach ($usersname as $element ) {
    		echo "<ul>";
    		/*echo "<li>".$element->id_admin."</li>";
    		echo "<ul>";*/
    		echo "<li>".$element->name."</li>";
    		/*echo "<li>".$element->email."</li>";
    		echo "<li>".$element->password."</li>";
    		echo "</ul>";*/
    		echo "</ul>";
    	}


    }
   	public function selectadminname($id)
    {
    	//$maxid=DB::selectOne("SELECT MAX(id_admin) as max FROM Admins");
    	$maxid=DB::table('admins')->max('id_admin');
    	

  	if ($id <= $maxid and $id > 0) {
    		
    	
    	$adminname=DB::selectOne("SELECT name FROM Admins WHERE id_admin=".$id." ORDER BY id_admin" );
    		
    		echo "<h3> your requested admin name is = <b>".$adminname->name."</b></h3>";
    		/*dd($adminname);*/

		}else{echo "ID OUT OF RANGE";}
    	


    }

    public function selectallproducts()
    {

    	$products=DB::select("SELECT * FROM Produit");
    	

    		echo "<table >";
    		echo "<thead >";
    		echo "<tr><td>Code</td><td>Reference</td><td>Designation</td><td>Prix Unitaire</td></tr>";
    		echo "</thead >";
    		echo "<tbody >";
    		foreach ($products as $element ) {
    			echo "<tr>";
    			echo "<td>". $element->code_produit ."</td>";
    			echo "<td>". $element->Reference ."</td>";
    			echo "<td>". $element->designation ."</td>";
    			echo "<td>". $element->prix_unitaire ."</td>";
    			echo "</tr>";
    		}
    		echo "</tbody >";
    		echo "<table>";

    	

    }
        public function selectallproductswithcategorie()
    {

    	$products=DB::table('produit')
    					->join('Categorie','produit.Code_categorie','=','Categorie.Code_categorie')
    					->join('utilisateur','produit.code_utilisateur','=','utilisateur.code_utilisateur')
    					->get();
    	
			
    		echo "<table >";
    		echo "<thead >";
    		echo "<tr>
    			<td>Referance</td>
    			<td>Designation</td>
    			<td>Prix Unitaire</td>
    			<td>Type</td>
    			<td>fournir par</td>
    			</tr>";
    		echo "</thead >";
    		echo "<tbody >";
    		foreach ($products as $element ) {
    			echo "<tr>";
    			echo "<td>". $element->Reference ."</td>";
    			echo "<td>". $element->designation ."</td>";
    			echo "<td>". $element->prix_unitaire ."</td>";
    			echo "<td>". $element->libelle ."</td>";
    			echo "<td>". $element->name ."</td>";
    			echo "</tr>";
    		}
    		echo "</tbody >";
    		echo "<table>";

    	

    }


    public function selectalltypesamounts()
    {

    	$types_amounts=DB::table('Produit')
    						->select('Code_categorie',DB::Raw('count(prix_unitaire) as number,SUM(prix_unitaire) as amount'))
    						->groupBy('Code_categorie')
    						->get();



		echo "<table >";
		echo "<thead >";
		echo "<tr><td>code categorie</td><td>total amount</td><td>number</td></tr>";
		echo "</thead >";
		echo "<tbody >";
		foreach ($types_amounts as $element ) {
			echo "<tr>";
			echo "<td>". $element->Code_categorie ."</td>";
			echo "<td>". $element->amount ."</td>";
			echo "<td>". $element->number ."</td>";
			echo "</tr>";
		}
		echo "</tbody >";
		echo "<table>";				

    }



}
