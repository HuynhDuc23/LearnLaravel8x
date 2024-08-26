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
    <h1>{{ $title ? $title : 'Default value' }}</h1>
    @if (session('success'))
        <div class="alert alert-success mt-2"> {{ session('success') }} </div>
    @endif
    @if (session('msg'))
        <div class="alert alert-success mt-2"> {{ session('msg') }} </div>
    @endif
    <form action="{{ route('post.delete') }}" method="post" onsubmit="return confirm('Delete ?')">
        @csrf
        @method('post')
        <button type="submit" class="btn btn-danger">Delete(0)</button>
        <table class="table">
            <thead>
                <tr>
                    <th width="10%">Select</th>
                    <th scope="col">STT</th>
                    <th width="10%">Title</th>
                    <th width="10%">Name</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($records))
                    @foreach ($records as $key => $record)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" value="{{ $record->id }}">
                            </td>
                            <td scope="row">{{ ++$key }}</td>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->name }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Danh Sach Dang Trong</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </form>
    <div class="justify-content-end">
    </div>
@endsection
@section('js')
@endsection
