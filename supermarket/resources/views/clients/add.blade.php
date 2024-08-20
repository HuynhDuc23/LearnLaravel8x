@extends('layouts.client')
@section('css')
@endsection
@section('title')
    {{ !empty($title) ? $title : '' }}
@endsection
@section('content')
    <form action="" method="POST">
        @csrf
        @method('POST')
        @error('name')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
        <input type="text" name="name" placeholder="Nhập tên sản phẩm" class="@error('name') is-invalid @enderror"
            value="{{ old('name') }}">
        <button type="submit">Thêm sản phẩm</button>

    </form>
    @error('msg')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
    @if (session('msg'))
        <div class="alert alert-success mt-2 ">
            {{ session('msg') }}
        </div>
    @endif
    <x-alert type="info" :message="$title" />
@endsection
@section('js')
@endsection
