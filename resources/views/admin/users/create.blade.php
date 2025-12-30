@extends('adminlte::page')

@section('content')
<form method="POST" action="{{ route('users.store') }}">
@csrf

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="name" class="form-control">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control">
</div>

<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
</div>

<div class="form-group">
    <label>Role</label>
    <select name="role" class="form-control">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
</div>

<button class="btn btn-primary">Simpan</button>
</form>
@endsection