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
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            Tambah Admin
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if($user->status == 'aktif')
                     <span class="badge badge-success">Aktif</span>
                        @else
                        <span class="badge badge-danger">Tidak Aktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.edit',$user->id) }}"
                       class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('users.destroy',$user->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data?')">
                            Hapus
                        </button>
                    </form>
                    <form action="{{ route('users.toggleStatus', $user->id) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-info btn-sm">
                            {{ $user->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                         </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection