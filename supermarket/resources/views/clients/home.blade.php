@extends('layouts.client')


@section('css')
    <style>
        header {
            background-color: yellow;
            text-transform: uppercase;
        }
    </style>
@endsection
@section('title')
    {{ $title }}
@endsection
@section('sidebar')
    {{-- @parent --}}
    <h3>Home Sidebar</h3>
@endsection
@section('content')
    <h1>Home</h1>
@endsection
@section('js')
    <script>
        document.getElementById('btn').onclick = function() {
            alert('Submit thành công!');
        }
    </script>
@endsection
