@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <h2>Bienvenue Admin</h2>
                {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection