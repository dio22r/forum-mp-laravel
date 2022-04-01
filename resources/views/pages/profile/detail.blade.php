@extends('layouts.app')

@section('title', 'Detail Account')

@section('content')


<div class="card">
    <div class="card-header">
        Detail Account
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                @if (!auth()->user()->hasVerifiedEmail())
                <div class="alert alert-warning" role="alert">
                    <strong>Maaf, Akun anda belum melakukan verifikasi email.</strong>
                    Silahkan periksa email anda terlebih dahulu dan klik tombol verifikasi pada email tersebut
                    agar bisa berinteraksi dalam forum GPdI Sulut.
                    Jika belum mendapatkan email silahkan tekan tombol "Send Verified Email" dibawah untuk mengirim ulang
                    link verifikasi.
                </div>
                @endif
            </div>
        </div>
        <dl class="row">
            <dt class="col-sm-2">Nama</dt>
            <dd class="col-sm-10">
                <h5>{{ $user->name }}</h5>
            </dd>

            <dt class="col-sm-2">Email</dt>
            <dd class="col-sm-10">{{ $user->email }}</dd>

            <dt class="col-sm-2">User Role</dt>
            <dd class="col-sm-10">
                <ul>
                    @foreach ($user->role as $role)
                    <li>{{ $role->name }}</li>
                    @endforeach
                </ul>
            </dd>

            @if($user->MhGereja->count() > 0)
            <dt class="col-sm-2">Gereja</dt>
            <dd class="col-sm-10">
                {{ $user->MhGereja[0]->name }} <br />
                Wilayah: {{ $user->MhGereja[0]->MhWilayah->code }}
                {{ $user->MhGereja[0]->MhWilayah->name }} <br />
            </dd>
            @endif
        </dl>

        <a href="{{ route('account.edit') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i>
            Edit Account
        </a>
        @if (!auth()->user()->hasVerifiedEmail())
        <form class="d-inline" method="post" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-warning">
                <i class="fas fa-envelope"></i>
                Send Verified Email
            </button>
        </form>
        @endif
    </div>
</div>


@endsection
