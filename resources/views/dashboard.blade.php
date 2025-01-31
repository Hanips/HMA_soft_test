@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Pengguna</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $totalUsers }}</h2>
                    <p class="card-text">Pengguna Terdaftar</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Pengguna Aktif</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $loggedInUsers }}</h2>
                    <p class="card-text">Pengguna dengan Status Aktif</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
