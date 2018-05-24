@extends('layouts.app')

@section('content')
<?php 
use Carbon\Carbon;
Carbon::setLocale('fr');
 ?>

<head>
   <script src="{{ asset('js/Dashboard.js') }}" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
       <link href="{{ URL::asset('/css/dashboard.css') }}" rel="stylesheet" type="text/css" >

</head>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card" >
                <div class="card-header no-padd">
                            <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#clients">CHEFS DES DVs <span class="badge badge-large badge-primary">{{count($clients)}}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#admins">ADMINS <span class="badge badge-primary">{{count($admins)}}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fournisseurs">FOURNISSEURS <span class="badge badge-primary">{{count($fournisseurs)}}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#produit">PRODUITS <span class="badge badge-primary">{{count($products)}}</span></a></li>  
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#commandes">COMMANDES <span class="badge badge-warning">{{count($commandes)}}</span></a></li>                                                      
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#statistics">STATISTIQUES</a></li>                                                      
                          </ul>
                </div>
                <div class="card-body no-padd">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                      <div class="tab-content">
                        <div id="clients" class="container-fluid tab-pane active no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                <div class="input-group col-md-5">
                                  <input id="searche_client" type="text" class="form-control col-md-12"  placeholder="Recherche..." onkeyup="tables_serache('client')">
                                </div>
                                <div class="col-md-7" >
                                    <button type="button" class="btn btn-success col-md-4 pull-right " onclick="display_add_user_form('client')">AJOUTER</button>
                                </div>
                            </div>
                            <br>
                            <br>
                            <table class="table table-striped table-responsive-sm  no-padd">
                                 <tbody id="clients_table" >
                                    <tr class="thead-dark">
                                        <th>Chef De Division</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                         
                               
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>
                                            <button type="button" class="btn btn-small btn-primary col-md-12 " onclick="display_update_user_form({{ $client->id }})">MODIFIER</button>                                            
                                       </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>                          
                        </div>
                        <div id="admins" class="container-fluid tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                <div class="input-group col-md-5">
                                  <input id="searche_admin" type="text" class="form-control col-md-12"  placeholder="Recherche..." onkeyup="tables_serache('admin')">
                                </div>
                                <div class="col-md-7">
                                    <button type="button" class="btn btn-success col-md-4 pull-right " onclick="display_add_user_form('admin')">AJOUTER</button>
                                </div>
                            </div>
                            <br>
                            <br>                           
                            <table class="table table-striped  table-responsive-sm  col-md-12 no-padd ">
                          <tbody id="admins_table">
                                    <tr class="thead-dark">
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                    
                              
                                    @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <button type="button" class="btn btn-small btn-primary col-md-12 " onclick="display_update_user_form({{ $admin->id }})">MODIFIER</button>                                            
                                       </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>
                        </div>
                        <div id="fournisseurs" class="container-fluid tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                    <div class="input-group col-md-5">
                                      <input id="searche_fournisseur" type="text" class="form-control col-md-12"  placeholder="recherche..." onkeyup="tables_serache('fournisseur')">
                                      
                                    </div> 
                                    <div class="col-md-7">

                                        <button type="button" class="btn btn-success col-md-4 pull-right " onclick="display_fournisseur_form('add',0)">AJOUTER</button>
                                    </div> 
                                </div> 
                            <br>
                            <br>                           
                            <table class="table  table-responsive-sm table-striped col-md-12 no-padd" >
                               <tbody id="fournisseurs_table">
                                    <tr class="thead-dark">
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>adresse</th>
                                        <th>Telephone</th>
                                        <th></th>
                                    </tr>
                                
                               
                                    @foreach($fournisseurs as $fournisseur)
                                    <tr>
                                        <td >{{ $fournisseur->name }}</td>
                                        <td >{{ $fournisseur->email }}</td>
                                        <td >{{ $fournisseur->adresse }}</td>
                                        <td >{{ $fournisseur->telephone }}</td>
                                        <td>
                                            <button type="button" class="btn btn-small btn-primary col-md-12 " onclick="display_fournisseur_form('update',{{ $fournisseur->code_fournisseur }})">MODIFIER</button>                                            
                                       </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>
                        </div>
                        <div id="produit" class="container-fluid tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                    <div class="input-group col-md-5">
                                      <input id="searche_product" type="text" class="form-control col-md-12"  placeholder="recherche..." onkeyup="tables_serache('product')">
                                      
                                    </div> 
                                    <div class="col-md-7 " >
                                        <button  type="button" class="btn btn-success col-md-4 pull-right " onclick="display_produit_form('add',0)">AJOUTER</button>
                                    </div> 
                                </div> 
                            <br>
                            <br>                           
                            <table class="table  table-responsive-sm  col-md-12 no-padd" >
                                <tbody id="products_table">
                                    <tr class="thead-dark">
                                        <th>Référence</th>
                                        <th>Designation</th>
                                        <th>Catégorie</th>
                                        <th>Prix Unitaire</th>
                                        <th>Fournie par</th>
                                        <th>Quantité</th>
                                        <th></th>
                                    </tr>
                            
                                
                                    @foreach($products as $produit)
                                        @if($produit->quantite < 50)
                                            <tr class="alert alert-danger">
                                                <td >{{ $produit->Reference }}</td>
                                                <td >{{ $produit->designation }}</td>
                                                <td >{{ $produit->libelle }}</td>
                                                <td >{{ $produit->prix_unitaire }}</td>
                                                <td >{{ $produit->name }}</td>
                                                <td >{{ $produit->quantite }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-primary col-md-12 " onclick="display_produit_form('update',{{ $produit->code_produit }})">MODIFIER</button>                                            
                                               </td>                                         
                                            </tr>
                                        @else
                                            <tr >
                                                <td >{{ $produit->Reference }}</td>
                                                <td >{{ $produit->designation }}</td>
                                                <td >{{ $produit->libelle }}</td>
                                                <td >{{ $produit->prix_unitaire }}</td>
                                                <td >{{ $produit->name }}</td>
                                                <td >{{ $produit->quantite }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-primary col-md-12 " onclick="display_produit_form('update',{{ $produit->code_produit }})">MODIFIER</button>                                            
                                               </td>                                         
                                            </tr>                                        
                                        @endif
                                    @endforeach
                                </tbody>
                               </table>
                        </div>
                        <div id="commandes" class="container-fluid tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">

                                    <div class=" col-md-4 no-padd">
                                        <b><label class="col-md-4 modal-label control-label pull-left ">Recherche : </label></b>
                                      <input id="searche_commande" type="text" class="form-control col-md-8 pull-right"  placeholder="recherche..." onkeyup="tables_serache('commande')">
                                    </div> 

                                    <div class=" col-md-4 no-padd">
                                      <b><label class="col-md-4 modal-label control-label pull-left ">Année : </label></b>
                                      <div class="col-md-8 pull-right no-padd">
                                        <select class="form-control" id="annee"  > 
                                            <option value="Tout">Tout</option>
                                            @foreach($years as $year)
                                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                                            @endforeach

                                        </select>
                                      </div>
                                    </div> 

                                    <div class=" col-md-4 no-leftpadd">
                                      <b><label class="col-md-4 modal-label control-label pull-left ">Etat : </label></b>
                                      <div class="col-md-8 pull-right no-padd">
                                        <select class="form-control" id="etat" >
                                            <option value="Tout">Tout</option>
                                            <option value="2">En attente</option>
                                            <option value="1">Confirmer</option>
                                            
                                        </select>
                                      </div>
                                    </div>                                     
                                </div> 
                            <br>
                            <br>                            
                            <table class="table table-striped table-responsive-sm table-condensed  col-md-12 no-padd" id="filtre_commandes">

                                 <tbody id="commandes_table" >                                    
                                    <tr class="thead-dark">
                                        <th>N° de Commande</th>
                                        <th>Chef de Dv</th>
                                        <th>Date</th>
                                        <th>Période</th>
                                        <th>Détails</th>
                                    </tr>
                                    @foreach($commandes as $commande)
                                    <tr>
                                        <td >{{ $commande->numero_cmnd }}</td>
                                        <td >{{ $commande->name }}</td>
                                        <td >{{ $commande->date_effectue }}</td>
                                        <td >{{ Carbon::now()->subDays(Carbon::parse($commande->date_effectue)->diffInDays(Carbon::now()))->diffForHumans() }}   </td>
                                        <td><button class="btn btn-small btn-dark col-md-12" onclick="cmnd_det({{$commande->numero_cmnd}})">Voir les détails </button></td>
                                    </tr>
                                    @endforeach
                                </tbody> 
                           </table>
                        </div>


                        <div id="statistics" class="container-fluid tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                    <div class=" col-md-6 no-leftpadd">
                                      <b><label class="col-md-4 modal-label control-label pull-left ">HAUT </label></b>
                                      <div class="col-md-8 pull-right no-padd">
                                        <select class="form-control" id="top10" >
                                            <option value="FOURNISSEURS">FOURNISSEURS</option>
                                            <option value="CLIENTS">CHEFS DES DVs</option>
                                            <option value="PRODUITS">PRODUITS</option>
                                            <option value="CATEGORIE">CATEGORIE</option>
                                        </select>
                                      </div>
                                    </div> 

                                    <div class=" col-md-6 no-padd">
                                      <b><label class="col-md-4 modal-label control-label pull-left ">POUR </label></b>
                                      <div class="col-md-8 pull-right no-padd">
                                        <select class="form-control" id="top10year"  > 
                                            <option value="Tout">Tout</option>
                                            @foreach($years as $year)
                                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                                            @endforeach

                                        </select>
                                      </div>
                                    </div> 
                                </div>    
                                <br>
                                <br>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="card col-md-12 no-padd">
                                            <div class="card-header no-padd">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item col-md-6 no-padd"><a class="nav-link" data-toggle="tab" href="#chart">CHART </a></li>
                                                    <li class="nav-item col-md-6 no-padd"><a class="nav-link active" data-toggle="tab" href="#table">TABLE </a></li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    
                                                
                                                <div id="chart" class="container-fluid tab-pane fade no-padd">
                                    <canvas id="mycharts" class="chartjs" height="100px"></canvas>
                                </div>
                              
                            <div id="table" class="container-fluid tab-pane fade no-padd active">
                                <table class="table table-striped table-responsive-sm table-condensed  col-md-6 no-padd" id="statistics_table">
                                </table>
                            </div> </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                </div>
                                                 
                           
                        </div>

                        </div>

                            </div>
                        </div>                                                
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <div id="cmnd_dtls_modal" class="modal2">
      <!-- Modal content -->
        <div class="modal2-content" >
            <div class="modal2-header">
                <span class="close2">&times;</span>
              <h2 id="cmnd_dtls_nbr">Détails du commande N°: </h2>
            </div>
            <div class="modal2-body no-padd"><div class="col-md-12"><div class="col-md-12  alert alert-danger modal2" id="modal-alert"></div></div>
                <div class="container-fluid no-padd cmnd_table">
                    <div class="col-md-12 no-padd ">
                        
                           <table class="table  table-responsive-sm col-md-12 no-margin "  id="cmnd_dtls_table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th> REFERENCE </th>
                                        <th> DESIGNATION </th>
                                        <th> CATEGORIE </th>
                                        <th> PRIX UNIT </th>
                                        <th> QUANTITE </th>
                                        <th> PRIX TOTAL </th>
                                    </tr>
                                </thead>
                           
                        
                    </table>

                    </div>
                    <div class="container-fluid no-padd">
                            <table class="table table-striped  table-responsive-sm col-md-12 no-margin" >
                                <thead class="thead-dark no-padd">
                                    <tr >
                                        <th class=""><h5 id="cmnd_dtls_date">DATE : </h5></th>
                                        <th class=""><h5 id="cmnd_dtls_client">CHEF DE DV : </h5></th>
                                        <th class=""><h5 class="pull-right">PRIX TOTAL </h5></th>
                                        <th><input id="cmnd_dtl_prix_total" class="pull-right fitt-in form-control col-md-12" type="number" name="cmnd_tprice" placeholder="" disabled="true"></th>
                                    </tr>
                                </thead>                  
                            </table>   
                        </div>
                </div>
            </div>
            <div class="modal2-footer clearfix">
                <div class="btn-group col-md-12  no-padd">
                        <div class="col-md-8">
                            <input  class="form-control col-md-12 my_btn_margin" type="text" placeholder="Tapez votre message a envoyé " id="message" >
                            <div class="alert no-margin" id="alerto" style="padding-top:0.5rem;padding-bottom: 0.5rem "></div>
                        </div>
                    
                    <div class="col-md-4 btn-group">
                        
                        <div class="col-md-6 "><button class="btn btn-danger   col-md-12 my_btn_margin" onclick="cancel()">Fermer</button></div>
                        <div class="col-md-6 "><button class="btn btn-warning  col-md-12  my_btn_margin" id="approver" >Approuver</button></div>
                            
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>








<div id="ajouter" class="modal2">

  <!-- Modal content -->
    <div class="modal2-content" id="small-model-content">
        <div class="modal2-header">
            <span class="close2">&times;</span>
          <h2 class="modal-title" id="modal-titel"></h2>
        </div>
        <div class="input-group clearfix">
            <div class="container-fluid no-padd">
                <div class="col-md-12">
                    <div class="form-horizontal container-fluid" >
                        <div class="alert alert-danger modal2" id="modal-alert">
                            not in here 
                        </div>
                        <div class="form-group">
                          <b><label class="col-md-4 modal-label control-label pull-left ">Chef de Division</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="name" type="text" placeholder="chef de division" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <b><label class="col-md-4 modal-label control-label pull-left ">Email de Division</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="email" type="Email" placeholder="Email de division" required>
                          </div>
                        </div>                        
                        <div class="form-group ">
                          <b><label class="col-md-4 modal-label control-label pull-left " id="label-password">Password</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="password" type="password" placeholder="Password" required>
                          </div>
                        </div>  
                        <div class="form-group ">
                          <b><label class="col-md-4 modal-label control-label pull-left " id="label-Repassword">Confirmer password</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="repassword" type="password" placeholder="Confirmer password" required>
                          </div>
                        </div>  
                        <div class="form-group">
                            <div class="col-md-12 ">
                                <button class="btn btn-primary col-md-3 pull-right" id="valider" >Ajouter</button>
                                <button class="btn btn-warning col-md-3 pull-right " onclick="cancel()">Fermer</button>
                            </div>
                          
                        </div>                                                                                              
                      </div>                  
                </div>
            </div>
        </div>
        

    </div>

</div>




<div id="Fournisseur" class="modal2">

  <!-- Modal content -->
    <div class="modal2-content" id="small-model-content">
        <div class="modal2-header">
            <span class="close2">&times;</span>
          <h2 class="modal-title" id="modal-titel"></h2>
        </div>
        <div class="input-group clearfix">
            <div class="container-fluid no-padd">
                <div class="col-md-12">
                    <div class="form-horizontal container-fluid" >
                        <div class="alert alert-danger modal2" id="modal-alert">
                            not in here 
                        </div>
                        <div class="form-group">
                          <b><label class="col-md-4 modal-label control-label pull-left ">Nom</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="F_name" type="text" placeholder="Nom de fournisseur" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <b><label class="col-md-4 modal-label control-label pull-left ">Email</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="F_email" type="Email" placeholder="Email de fournisseur" required>
                          </div>
                        </div>                        
                        <div class="form-group clearfix">
                          <b><label class="col-md-4 modal-label control-label pull-left " id="label-password">Adresse</label></b>
                          <div class="col-md-8 pull-right">
                            <textarea class="form-control" id="F_adresse" type="text" placeholder="Adresse de fournisseur" required ></textarea>
                          </div>
                        </div>  
                        <div class="form-group ">
                          <b><label class="col-md-4 modal-label control-label pull-left " id="label-Repassword">Télephone</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="F_telephone" type="text" placeholder="Telephone de fournisseur" required>
                          </div>
                        </div>  
                        <div class="form-group">
                            <div class="col-md-12 ">
                                <button class="btn btn-primary col-md-4 pull-right" id="valider" >Ajouter</button>
                                <button class="btn btn-danger col-md-3 pull-right " onclick="cancel()">Fermer</button>
                            </div>
                          
                        </div>                                                                                              
                      </div>                  
                </div>
            </div>
        </div>
        

    </div>

</div>


<div id="Produit" class="modal2">
  <!-- Modal content -->
    <div class="modal2-content" id="small-model-content">
        <div class="modal2-header">
            <span class="close2">&times;</span>
          <h2 class="modal-title" id="modal-titel"></h2>
        </div>
        <div class="input-group clearfix">
            <div class="container-fluid no-padd">
                <div class="col-md-12">
                    <div class="form-horizontal container-fluid" >
                        <div class="alert alert-danger modal2" id="modal-alert">
                            not in here 
                        </div>
                        <div class="form-group">
                          <b><label class="col-md-4 modal-label control-label pull-left ">Référence</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="Reference" type="text" placeholder="Référance" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <b><label class="col-md-4 modal-label control-label pull-left ">Designation</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="Designation" type="text" placeholder="Designation" required>
                          </div>
                        </div>                        
                        <div class="form-group clearfix">
                          <b><label class="col-md-4 modal-label control-label pull-left ">catégorie</label></b>
                          <div class="col-md-8 pull-right">
                            <select class="form-control" id="Categorie" required >
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->code_categorie }}">{{ $categorie->libelle }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>  
                        <div class="form-group ">
                          <b><label class="col-md-4 modal-label control-label pull-left " id="label-Prix_unit">Prix unitaire</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="Prix_unit" type="number" min="1" placeholder="Prix unitaire" required>
                          </div>
                        </div>  
                        <div class="form-group ">
                          <b><label class="col-md-4 modal-label control-label pull-left " >Fournie par</label></b>
                          <div class="col-md-8 pull-right">
                            <select class="form-control" id="Fourni_par" type="text"  required>
                                @foreach($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->code_fournisseur }}">{{ $fournisseur->name }}</option>
                                @endforeach                                
                            </select>
                          </div>
                        </div> 
                        <div class="form-group ">
                          <b><label class="col-md-4 modal-label control-label pull-left " >Quantité</label></b>
                          <div class="col-md-8 pull-right">
                            <input class="form-control" id="Quantite" type="number" min="1" placeholder="Quantité" required>
                          </div>
                        </div>                                                 
                        <div class="form-group">
                            <div class="col-md-12 ">
                                <button class="btn btn-primary col-md-4 pull-right" id="valider" >Ajouter</button>
                                <button class="btn btn-danger col-md-3 pull-right " onclick="cancel()">Fermer</button>
                            </div>
                          
                        </div>                                                                                              
                      </div>                  
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
