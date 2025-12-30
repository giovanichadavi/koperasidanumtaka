@extends('adminlte::page')

@section('content')
<table class="table">
@foreach($posts as $post)
<tr>
    <td>{{ $post->title }}</td>

    @if(auth()->user()->role === 'admin')
    <td>
        <a href="{{ route('posts.edit',$post) }}">Edit</a>
        <form method="POST" action="{{ route('posts.destroy',$post) }}">
            @csrf @method('DELETE')
            <button>Delete</button>
        </form>
    </td>
    @endif
</tr>
@endforeach
</table>

@if(auth()->user()->role === 'admin')
<a href="{{ route('posts.create') }}" class="btn btn-primary">Tambah</a>
@endif
@endsection