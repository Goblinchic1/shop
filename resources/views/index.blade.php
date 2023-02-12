@extends('layouts.app')

@section('content')
    @auth
        <form method="POST" action="{{ route('logOut') }}">
            @csrf
            @method('DELETE')
            <button type="submit">Выйти</button>
        </form>
    @endauth
@endsection
