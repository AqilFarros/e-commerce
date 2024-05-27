@extends('layouts.parent')

@section('title', 'My Transaction')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">My Transaction</h5>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Transaction</a></li>
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
                        <th>Receiver Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Price</th>
                        <th>Payment URL</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaction as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->user->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->total_price }}</td>
                            <td>
                                @if ($row->payment_url == 'NULL')
                                @else
                                    <a href="{{ $row->payment_url }}">MIDTRANS</a>
                                @endif
                            </td>
                            <td>
                                @if ($row->status == "expired")
                                    <span class="badge bg-danger">Expired</span>
                                @elseif ($row->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($row->status == 'settlement')
                                    <span class="badge bg-info">Settlement</span>
                                @else
                                    <span class="badge bg-success">Success</span>
                                @endif
                            </td>
                            <td>
                                    <a href="#" class="btn btn-primary btn-sm mx-2">Show</a>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#updateStatus{{ $row->id }}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        @include('pages.admin.transaction.modal-edit')
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
