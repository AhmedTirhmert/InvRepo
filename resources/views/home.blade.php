@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding: 0">
            <div class="card">
                <div class="card-header">Votre Commandes
                <button  class="btn btn-large btn-primary " style="float: right">Nouvelle Commande</button>
                </div>

                <div class="card-body" style="padding: 0;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                   <table class="table  table-hover table-striped table-responsive-sm col-md-12">
                        <thead class="thead-dark">
                        <tr>
                            <th>N° Commande</th>
                            <th>Effectué Le</th>
                            <th>Etat de commande</th>
                            <th>Par : </th>
                            <th></th>
                        </tr>
                        </thead>
                        @foreach($commandes as $commande)
                        
                        @if($commande->id_etat == 1)
                        <tr class="table-success" >
                        @elseif($commande->id_etat == 2)
                        <tr class="table-danger" >
                        @elseif($commande->id_etat == 3)
                        <tr class="table-warning" >                            
                        @endif  
                         
                            <td>{{$commande->numero_cmnd}}</td>
                            <td>{{$commande->date_effectue}}</td>
                            <td >{{$commande->etat}} </td>
                            <td >{{$commande->name}}</td>
                            <td><button class="btn-dark" style="float: right" >Voir Plus </button></td>
                        </tr>
                        
                        @endforeach
                   </table>
                    <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
