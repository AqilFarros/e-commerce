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
            <h5 class="card-title"><i class="bi bi-cart"></i> My Transaction</h5>

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name Account</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Action</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($myTransaction as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->user->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>
                                @if ($row->status == 'Expired')
                                    <span class="badge bg-danger text-uppercase">Expired</span>
                                @elseif ($row->status == 'PENDING')
                                    <span class="badge bg-warning text-uppercase">Pending</span>
                                @elseif ($row->status == 'SETTLEMENT')
                                    <span class="badge bg-info text-uppercase">Settlement</span>
                                @else
                                    <span class="badge bg-success text-uppercase">Success</span>
                                @endif
                            </td>
                            <td>{{ $row->total_price }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#showTransaction{{ $row->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                            <td>
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('admin.my-transaction.showDataBySlugAndId', [$row->slug, $row->id]) }}"
                                        class="btn btn-primary">Show</a>
                                @else
                                    <a href="{{ route('user.my-transaction.showDataBySlugAndId', [$row->slug, $row->id]) }}"
                                        class="btn btn-primary">Show</a>
                                @endif
                            </td>
                        </tr>
                        @include('pages.admin.my-transaction.modal-show')
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Transaction</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
