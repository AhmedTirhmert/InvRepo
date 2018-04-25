@extends('layouts.app')

@section('content')

<?php 
use Carbon\Carbon ;
Carbon::setLocale('fr');
?>


</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding: 0">
            <div class="card" >
                <div class="card-header no-padd">
                            <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#clients">CLIENTS <span class="badge badge-large badge-primary">{{count($clients)}}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#admins">ADMINS <span class="badge badge-primary">{{count($admins)}}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fournisseurs">FOURNISSEURS <span class="badge badge-primary">{{count($fournisseurs)}}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#produit">PRODUCTS <span class="badge badge-primary">{{count($products)}}</span></a></li>  
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#commandes">COMMANDES <span class="badge badge-warning">{{count($commandes)}}</span></a></li>                                                      
                          </ul>
                </div>
                <div class="card-body no-padd">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<!--                     <div class="alert-border">
You Welcome Mr/Mss  {{ Auth::user()->name }}
</div> -->
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div id="clients" class="container tab-pane active no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                        <div class="input-group col-md-8">
                                          <input id="searche_client" type="text" class="form-control col-md-10"  placeholder="Recherche...">
                                           
                                        </div>
                                        <div class="btn-group-justified col-md-4" >
                                            <button type="button" class="btn btn-success col-md-8 pull-right">NOUVEAU CLIENT</button>
                                        </div>
                            </div>




                            <br>
                            <br>
                            <table class="table table-striped table-responsive-sm table-bordered no-padd">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="clients_table" >
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        @if($client->id_type == 1)
                                        <td>Admin</td>
                                        @else
                                        <td>Client</td>
                                        @endif
                                        <td>
                                            <ul class="nav navbar-nav">
                                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <b class="caret"></b></a>
                                                    <ul class="dropdown-menu pull-left">
                                                        <li>  <button type="button" class="btn btn-success">NOUVEAU CLIENT</button>  </li>
                                                        <li>  <button type="button" class="btn btn-success">NOUVEAU CLIENT</button>  </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>                          
                        </div>
                        <div id="admins" class="container tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
<!--                                         <div class="input-group col-md-6">
                                          <input id="searche_admin" type="text" class="form-control "  placeholder="recherche...">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> 
                                        </div> -->
<!--                                         <div class="btn-group col-md-6" hidden>
                                            <button type="button" class="btn btn-success col-md-4">AJOUTER CLIENT</button>
                                            <button type="button" class="btn btn-primary col-md-4">MODIFIER CLIENT</button>
                                            <button type="button" class="btn btn-danger col-md-4">SUPRIMMER CLIENT</button>
                                        </div> -->

                            </div> 
                            <br>
                            <br>                           
                            <table class="table table-striped table-condensed table-responsive-sm table-bordered col-md-12 no-padd ">
                                <thead>
                                    <tr class="thead-dark">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody id="admins_table">
                                    @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        @if($admin->id_type == 1)
                                        <td>Admin</td>
                                        @else
                                        <td>Client</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>
                        </div>
                        <div id="fournisseurs" class="container tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                        <div class="input-group col-md-6">
                                          <input id="searche_fournisseur" type="text" class="form-control "  placeholder="recherche...">
                                          <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> -->
                                        </div>
                                        <div class="btn-group col-md-6" hidden>
                                            <button type="button" class="btn btn-success col-md-4">AJOUTER CLIENT</button>
                                            <button type="button" class="btn btn-primary col-md-4">MODIFIER CLIENT</button>
                                            <button type="button" class="btn btn-danger col-md-4">SUPRIMMER CLIENT</button>
                                        </div>
                            </div>
                            <br>
                            <br>                           
                            <table class="table table-striped table-responsive-sm table-bordered col-md-12 no-padd" >
                                <thead>
                                    <tr class="thead-dark">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>adresse</th>
                                        <th>Telephone</th>
                                    </tr>
                                </thead>
                                <tbody id="fournisseurs_table">
                                    @foreach($fournisseurs as $fournisseur)
                                    <tr>
                                        <td >{{ $fournisseur->name }}</td>
                                        <td >{{ $fournisseur->email }}</td>
                                        <td >{{ $fournisseur->adresse }}</td>
                                        <td >{{ $fournisseur->telephone }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>
                        </div>
                        <div id="produit" class="container tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                        <div class="input-group col-md-6">
                                          <input id="searche_client" type="text" class="form-control "  placeholder="recherche...">
                                          <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> -->
                                        </div>
                                        <div class="btn-group col-md-6" hidden>
                                            <button type="button" class="btn btn-success col-md-4">AJOUTER CLIENT</button>
                                            <button type="button" class="btn btn-primary col-md-4">MODIFIER CLIENT</button>
                                            <button type="button" class="btn btn-danger col-md-4">SUPRIMMER CLIENT</button>
                                        </div>
                            </div>
                            <br>
                            <br>                           
                            <table class="table table-striped table-responsive-sm table-bordered col-md-12 no-padd" >
                                <thead>
                                    <tr class="thead-dark">
                                        <th>Refference</th>
                                        <th>Designation</th>
                                        <th>Categorie</th>
                                        <th>Prix Unitaire</th>
                                        <th>Fourni par</th>
                                        <th>quantite</th>
                                    </tr>
                                </thead>
                                <tbody id="products_table">
                                    @foreach($products as $produit)
                                    <tr>
                                        <td >{{ $produit->Reference }}</td>
                                        <td >{{ $produit->designation }}</td>
                                        <td >{{ $produit->libelle }}</td>
                                        <td >{{ $produit->prix_unitaire }}</td>
                                        <td >{{ $produit->name }}</td>
                                        <td >{{ $produit->quantite }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>
                        </div>
                        <div id="commandes" class="container tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                        <div class="input-group col-md-6">
                                          <input id="searche_commande" type="text" class="form-control "  placeholder="recherche...">
                                          <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> -->
                                        </div>
                                        <div class="btn-group col-md-6" hidden>
                                            <button type="button" class="btn btn-success col-md-4">AJOUTER CLIENT</button>
                                            <button type="button" class="btn btn-primary col-md-4">MODIFIER CLIENT</button>
                                            <button type="button" class="btn btn-danger col-md-4">SUPRIMMER CLIENT</button>
                                        </div>
                            </div>
                            <br>
                            <br>                            
                            <table class="table table-striped table-responsive-sm table-hover table-condensed table-bordered col-md-12 no-padd" >
                                <thead>
                                    <tr class="thead-dark">
                                        <th>N° Commande</th>
                                        <th>Client</th>
                                        <th>Date effectue</th>
                                        <th>Detaile</th>
                                    </tr>
                                </thead>
                                <tbody id="commande_table" >
                                    @foreach($commandes as $commande)
                                    <tr>
                                        <td >{{ $commande->numero_cmnd }}</td>
                                        <td >{{ $commande->name }}</td>
                                        <td >{{ Carbon::now()->subDays(Carbon::parse($commande->date_effectue)->diffInDays(Carbon::now()))->diffForHumans() }} <!--{{$commande->date_effectue}}  --> </td>
                                        <td><button class="btn btn-small btn-dark pull-left" onclick="cmnd_det({{$commande->numero_cmnd}})">Voir detaile </button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                           </table>
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
          <h2>Detaile</h2>
        </div>
        <div class="modal2-body">
            <div class="container no-padd">


          <div class="col-md-12 no-padd">
                   <table class="table table-striped table-responsive-sm col-md-10 " id="cmnd_dtls_table1">
                        <thead class="thead-dark">
                        <tr>
                            <th> REFFERENCE </th>
                            <th> DESIGNATION </th>
                            <th> CATEGORIE </th>
                            <th> PRIX UNIT </th>
                            <th> QUANTITE </th>
                            <th> PRIX TOTAL </th>
                            
                        </tr>
                        </thead>
                    </table>
                    <div class="container-fluid">
                    <table class="table table-striped table-responsive-sm col-md-12 " >
                        <thead class="thead-dark no-padd">
                        <tr>
                            <th><h5><span id="cmnd_dtls_date" class="label label-danger">EFFECTUE LE : </span></h5></th>
                            <th class="no-padd"><label  for="cmnd_prix_total" class="label label-danger pull-right">PRIX TOTAL DE LA COMMANDE :</label></th><th><input id="cmnd_dtl_prix_total" class="pull-right fitt-in form-control col-md-12" type="number" name="cmnd_tprice" placeholder="" disabled="true"></th>
                        </tr>
                        </thead>                  
                   </table>   
       </div>
          </div>
      </div>
        </div>

    <div class="modal2-footer">
      
        </div>
    </div>
</div>




@endsection
