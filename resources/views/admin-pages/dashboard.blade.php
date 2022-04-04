@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">

    </div>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col col-12 col-md-6 col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Chart Pria / Wanita
                        </div>
                        <div class="card-body">
                            <canvas id="chart-gender" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-6 col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Chart Umur
                        </div>
                        <div class="card-body">
                            <canvas id="chart-umur" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">

        </div>
    </div>
</div>
@endsection
