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
    <h1>Danh Sach Nguoi Dung</h1>
    @if (session('success'))
        <div class="alert alert-success mt-2"> {{ session('success') }} </div>
    @endif
    @if (session('msg'))
        <div class="alert alert-success mt-2"> {{ session('msg') }} </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created_at</th>
                <th width="10%">Edit</th>
                <th width="10%">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($users))
                @foreach ($users as $key => $item)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('user.edit', [
                                'id' => $item->id,
                            ]) }}"
                                class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Are you sure delete?')"
                                href="{{ route('user.delete', ['id' => $item->id]) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>Danh Sach Dang Trong</td>
                </tr>
            @endif
        </tbody>
    </table>
    <a href="{{ route('user.get') }}" class="btn btn-primary mt-2">ADD</a>
@endsection
@section('js')
@endsection
