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
    <h1 style="text-align: center ; text-transform:uppercase">{{ $title ? $title : 'Default value' }}</h1>

    @if (session('msg-delete'))
        <div class="alert alert-danger mt-2"> {{ session('msg-delete') }} </div>
    @endif
    @if (session('msg'))
        <div class="alert alert-success mt-2"> {{ session('msg') }} </div>
    @endif
    <form action="{{ route('post.delete') }}" method="post" onsubmit="return confirm('Delete ?')">
        @csrf
        @method('post')
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('post.detail') }}" class="btn btn-primary">SoftDelete({{ $count }})</a>
        <a href="{{ route('post.restore') }}" class="btn btn-warning">RestoreAll({{ $count }})</a>
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">OPTION</th>
                    <th scope="col">STT</th>
                    <th width="5%">Title</th>
                    <th width="30%">Name</th>
                    <th width="5%">Status</th>
                    <th width="5%">Restore</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($records))
                    @foreach ($records as $key => $record)
                        <tr>
                            <td>
                                @if (!$record->trashed())
                                    <input type="checkbox" name="ids[]" value="{{ $record->id }}">
                                @endif
                            </td>
                            <td scope="row">{{ ++$key }}</td>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->name }}</td>
                            <td>
                                @if ($record->trashed())
                                    <a onclick="return confirm('Delete ?')"
                                        href="{{ route('post.soft', ['id' => $record->id]) }}"
                                        class="btn btn-danger">Deleted</a>
                                @else
                                    <span style="color: green">Active</span>
                                @endif
                            </td>
                            <td>
                                @if ($record->trashed())
                                    <a href="{{ route('post.postId', ['id' => $record->id]) }}"
                                        class="btn btn-success">Restore</a>
                                @else
                                    <span style="color: green">Active</span>
                                @endif
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
        <div>{{ $records->links() }}</div>
    </form>
    <div class="justify-content-end">
    </div>
@endsection
@section('js')
@endsection
