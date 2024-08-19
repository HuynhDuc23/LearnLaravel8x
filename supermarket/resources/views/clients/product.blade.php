@extends('layouts.client')


@section('css')
    <style>
        h1 {
            background-color: red;
            text-transform: uppercase;
        }
    </style>
@endsection
@section('title')
    {{ $title_products }}
@endsection
@section('sidebar')
    {{-- @parent --}}
    <h3>Home Sidebar</h3>
@endsection
@section('content')
    <h1>TRANG CHủ</h1>
    <button type="submit" class="btn" id="btn">SUBMIT</button>
@endsection
@section('js')
@endsection
