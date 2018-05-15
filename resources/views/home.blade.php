@extends('layouts.app')

<?php 
use Carbon\Carbon ;
Carbon::setLocale('fr');
?>
@section('content')
<head>
       <script src="{{ asset('js/Home.js') }}" defer></script>
</head>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">Vos Commandes
                <button  class="btn btn-large btn-primary pull-right " id="popup">Nouvelle Commande </button>
                </div>

                <div class="card-body no-padd">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                   <table class="table  table-hover table-bordered table-striped table-responsive-sm col-md-12 no-padd" id="table_commandes">
                        <thead class="thead-dark">
                        <tr>
                            <th>N° Commande</th>
                            <th>Periode</th>
                            <th>Etat de commande</th>
                            <th >Par : </th>
                            <th></th>
                        </tr>
                        </thead>
                        @foreach($commandes as $commande)
                        @if($commande->id_etat == 1)
                        <tr class="table-success" >
                        @elseif($commande->id_etat == 2)
                        <tr class="table-warning" >                            
                        @endif  
                         
                            <td>{{$commande->numero_cmnd}}</td>
                            <td>{{ Carbon::now()->subDays(Carbon::parse($commande->date_effectue)->diffInDays(Carbon::now()))->diffForHumans() }}</td>
                            <td >{{$commande->etat}} </td>
                            <td >{{$commande->name}} (<small>{{ Carbon::now()->subDays(Carbon::parse($commande->date_effectue)->diffInDays(Carbon::now()))->diffForHumans() }}</small>)</td>
                            <td><button class="btn btn-small btn-dark pull-right" onclick="cmnd_det({{$commande->numero_cmnd}})">Voir les détails </button></td>
                        </tr>
                        @endforeach
                   </table>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal2">

  <!-- Modal content -->
    <div class="modal2-content clearfix" >
        <div class="modal2-header">
            <span class="close2">&times;</span>
          <h2 class="no-margin">Nouvelle Commande</h2>
        </div>
        <div class="modal2-body ">
            <div class="container-fluid no-padd">
                <div class="col-md-12 alert alert-border no-padd" style="padding: 0">
                    <form class="col-md-12 form-inline no-padd" >

                        <select value="select product" id="select_produit" class="form-control col-md-5">
                            @foreach($products as $product)
                                <option value="{{$product->prix_unitaire}}">{{$product->designation}}</option>
                            @endforeach
                        </select>
                        <select id="select_produit_id" class="form-control col-md-5" hidden>
                            @foreach($products as $product)
                                <option value="{{$product->code_produit}}"></option>
                            @endforeach
                        </select>                        
                       
                        <input id="prix_unitaire"   class="fitt-in form-control col-md-2" type="number" placeholder="prix_unitaire" disabled="true">
                        <input id="qty"             class="fitt-in form-control col-md-2" type="number" placeholder="Quantité" min="1">
                        <input id="prix_total"      class="fitt-in form-control col-md-2" type="number" placeholder="prix" disabled="true">
                        <input id="ajouter"         class="fitt-in form-control btn btn-small btn-success col-md-1 pull-right no-margin" type="button" name="ajouter_produit" value="Ajouter">
                    </form>
          </div>
          <div class="alert alert-danger modal2" id="alert_fill">
              Entrer une quantité valide :!
          </div>
          <div class="col-md-12 no-padd">
                   <table class="table table-striped table-responsive-sm col-md-12 no-padd" id="new_cmnd_products_table">
                        <thead class="thead-dark">
                        <tr>
                            <th> Produit </th>
                            <th> Prix Unaitaire </th>
                            <th> Quantité </th>
                            <th> prix total </th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                        <table class="table table-striped table-responsive-sm col-md-12 no-margin no-padd" >
                        <thead class="thead-dark no-padd">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="cmnd-total"><input id="cmnd_prix_total" class="pull-right fitt-in form-control col-md-4" type="number" name="cmnd_tprice" placeholder="" disabled="true"></th>
                        </tr>
                        </thead>                  
                   </table>   
       
          </div>
      </div>
        </div>

    <div class="modal2-footer clearfix">
        <div class="col-md-12 no-padd">
            <button  class="btn btn-large btn-primary col-md-2 pull-right" id="effectue"  >Effectuer</button>
            <button  class="btn btn-large btn-danger col-md-2 pull-right" id="btn-close">Annuler</button>
          </div>
        </div>
    </div>

</div>




    <div id="cmnd_dtls_modal" class="modal2">

  <!-- Modal content -->
    <div class="modal2-content" >
        <div class="modal2-header">
            <span class="close2">&times;</span>
          <h2 class="no-margin" id="cmnd_dtls_header">Commande N°=</h2>
        </div>
        <div class="modal2-body ">
            <div class="container-fluid no-padd alert alert-border">


          <div class="col-md-12 no-padd">
                   <table class="table table-striped table-responsive-sm col-md-12 no-padd" id="cmnd_dtls_table">
                        <thead class="thead-dark">
                        <tr>
                            <th> REFERENCE </th>
                            <th> DESIGNATION </th>
                            <th> CATEGORIE </th>
                            <th> PRIX UNIT </th>
                            <th> QUANTITE </th>
                            <th> PRIX TOTAL </th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                        <table class="table table-striped table-responsive-sm col-md-12 no-margin no-padd" >
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
</div>


@endsection
