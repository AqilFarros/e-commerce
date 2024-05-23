@extends('layouts.parent')

@section('title', 'My Transaction')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">My Transaction</h5>

            <nav>
                <ol class="breadcrumb">
                    @if (Auth::user()->role == 'admin')
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    @endif
                    <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                    <li class="breadcrumb-item active">My Transaction</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Transaction</h5>
        </div>
    </div>
@endsection
