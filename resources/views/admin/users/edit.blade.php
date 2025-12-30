@extends('adminlte::page')

@section('content')
<form method="POST" action="{{ route('users.update',$user->id) }}">
@csrf
@method('PUT')

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="name" class="form-control"
           value="{{ $user->name }}">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
           value="{{ $user->email }}">
</div>

<div class="form-group">
    <label>Password (Opsional)</label>
    <input type="password" name="password" class="form-control">
</div>

<div class="form-group">
    <label>Role</label>
    <select name="role" class="form-control">
        <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
        <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
    </select>
</div>

<button class="btn btn-success">Update</button>
</form>
@endsection