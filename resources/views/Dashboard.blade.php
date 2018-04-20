@extends('layouts.app')

@section('content')



<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 30%;
    height: 300px;
}

/* Style the buttons inside the tab */
.tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 70%;
    border-left: none;
    height: 300px;
}
</style>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding: 0">
            <div class="card" >
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You Welcome Mr/Mss  {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>



<!-- <div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Admins')">Admins</button>
  <button class="tablinks" onclick="openCity(event, 'Clients')">Clients</button>
  <button class="tablinks" onclick="openCity(event, 'Frns')">Frns</button>
    <button class="tablinks" onclick="openCity(event, 'Frns12')">Frns12</button>
</div>


<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script> -->






<div class="container">
    <div class="row justify-content-center">
<!-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You Welcome Mr/Mss  {{ Auth::user()->name }}
                </div>
            </div>
        </div> -->
        <div class="col-md-12" >
            <div class="row">
        <div class="col-md-12 " style="padding: 0" >
        <div class="col-md-12 " style="padding: 0">
            <div class="card tabcontent" id="Admins">
                <div class="card-header">Admins</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <table class="table-striped table-bordered col-md-12">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
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
                   </table>                    
                    
                </div>
            </div>
        </div>
        <div class="col-md-12 " style="padding: 0">
            <div class="card tabcontent" id="Clients">
                <div class="card-header">Clients</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <table class="table-striped table-bordered col-md-12" style="height: inherit;">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
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
                   </table>                    
                </div>
            </div>
        </div>           
        </div>
        <div class="col-md-12 " style="padding: 0">

        <div class="col-md-12 " style="height: 100% ; padding: 0">
            <div class="card tabcontent" id="Frns" style="height: inherit;">
                <div class="card-header">Fournisseurs</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <table class="table-striped  table-bordered col-md-12" >
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>adresse</th>
                            <th>Telephone</th>
                        </tr>
                        @foreach($fournisseurs as $fournisseur)
                        <tr>
                            <td >{{ $fournisseur->name }}</td>
                            <td >{{ $fournisseur->email }}</td>
                            <td >{{ $fournisseur->adresse }}</td>
                            <td >{{ $fournisseur->telephone }}</td>
                        </tr>
                        @endforeach
                   </table>                    
                </div>
            </div>
        </div>              
        </div>
        </div>
        </div>
        <div class="col-md-12 " style="padding: 0">
        <div class="col-md-12 " style="padding: 0">
            <div class="card tabcontent" id="Frns12">
                <div class="card-header">Fournisseurs</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <table class="table-striped  col-md-12">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>adresse</th>
                            <th>Telephone</th>
                        </tr>
                        @foreach($fournisseurs as $fournisseur)
                        <tr>
                            <td>{{ $fournisseur->name }}</td>
                            <td>{{ $fournisseur->email }}</td>
                            <td>{{ $fournisseur->adresse }}</td>
                            <td>{{ $fournisseur->telephone }}</td>
                        </tr>
                        @endforeach
                   </table>                    
                </div>
            </div>
        </div>
        </div>
    </div>

</div>
@endsection
