@extends('layouts.client')


@section('css')
@endsection
@section('title')
    {{ $title }}
@endsection
@section('sidebar')
    {{-- @parent --}}
    <h3>Home Sidebar</h3>
@endsection
@section('content')
    <h2 style="text-align: center ; color : red ; text-transform:uppercase">{{ $title }}</h2>
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-danger mt-2"> {{ session('msg') }}</div>
        @endif
        <form action="" method="POST">
            @csrf
            <div class="form-group nt-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="name..." name="name"
                    value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="form-group  mt-2">
                <label for="email">email</label>
                <input type="email" class="form-control" id="email" placeholder="email..." name="email"
                    value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary mt-2">ADD</button>
            <a href="{{ route('user.index') }}" class="btn btn-warning mt-2">BACK</a>
        </form>
    </div>
@endsection
@section('js')
@endsection
