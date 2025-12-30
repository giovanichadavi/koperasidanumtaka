@extends('adminlte::page')

@section('title','Manajemen Admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('navbar-right')
<li class="nav-item">
    <a class="nav-link" href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center header-admin">
            <h5 class="mb-0">Manajemen Admin</h5>

            <a href="{{ route('users.create') }}"
            class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Admin
            </a>
        </div>

            {{-- BODY --}}
            <div class="card-body">

                {{-- TABLE RESPONSIVE --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ $user->role }}</td>
                                <td class="text-center">
                                    @if($user->status == 'aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- TOMBOL RESPONSIF --}}
                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                        <a href="{{ route('users.edit',$user->id) }}"
                                           class="btn btn-warning btn-sm mr-1 mb-1">
                                            Edit
                                        </a>

                                        <form action="{{ route('users.destroy',$user->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm mr-1 mb-1"
                                                    onclick="return confirm('Hapus data?')">
                                                Hapus
                                            </button>
                                        </form>

                                        <form action="{{ route('users.toggleStatus', $user->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-info btn-sm mr-1 mb-1">
                                                {{ $user->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION RESPONSIVE --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection