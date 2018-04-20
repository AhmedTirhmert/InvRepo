@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                   <table class="table-striped col-md-12">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                        <tr>
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ Auth::user()->email }}</td>
                            @if(Auth::user()->id_type == 1)
                            <td>Admin</td>
                            @else
                            <td>Client</td>
                            @endif
                        </tr>

                   </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
