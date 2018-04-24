@extends('layouts.app')

@section('content')





</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding: 0">
            <div class="card" >
                <div class="card-header no-padd">
                            <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#clients">CLIENTS</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#admins">ADMINS</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fournisseurs">FOURNISSEURS</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#produit">PRODUCTS</a></li>  
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#commandes">COMMANDES</a></li>                                                      
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
                            <table class="table table-striped table-responsive-sm table-bordered no-padd">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                               </table>                          
                        </div>
                        <div id="admins" class="container tab-pane fade no-padd"><br>
                            <div class="btn-group col-md-12 no-padd">
                                        <div class="input-group col-md-6">
                                          <input id="searche_admin" type="text" class="form-control "  placeholder="recherche...">
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
                            <table class="table table-striped table-responsive-sm table-bordered col-md-12 no-padd" >
                                <thead>
                                    <tr class="thead-dark">
                                        <th>N° Commande</th>
                                        <th>Client</th>
                                        <th>Date effectue</th>
                                    </tr>
                                </thead>
                                <tbody id="commande_table" >
                                    @foreach($commandes as $commande)
                                    <tr>
                                        <td >{{ $commande->numero_cmnd }}</td>
                                        <td >{{ $commande->name }}</td>
                                        <td >{{ $commande->date_effectue }}</td>
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




@endsection
