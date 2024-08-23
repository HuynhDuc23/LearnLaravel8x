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
    <form action="" method="get">
        <div class="row mt-3">
            <div class="col-4">
                <input type="search" class="form-control" placeholder="Vui lòng nhập vào" name="keywords"
                    value="{{ request()->keywords }}">
            </div>
            <div class="col-3">
                <select name="group_id" id="" class="form-control" name="group_id">
                    <option value="0"> Tất cả các nhóm</option>
                    @if (!empty(getAllGroups()))
                        @foreach (getAllGroups() as $item)
                            <option value="{{ $item->id }}" {{ request()->group_id == $item->id ? 'selected' : false }}>
                                {{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-3">
                <select id="" class="form-control" name="status">
                    <option value="0">Tất Cả Trạng thái</option>
                    <option value="active" {{ request()->status == 'active' ? 'selected' : false }}> Kích hoạt</option>
                    <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : false }}> Chưa kích hoạt
                    </option>
                </select>
            </div>
            <div class="col-2">
                <button type="submit" name='search' value="search" class="btn btn-primary btn-block"> Tìm kiếm</button>
            </div>

        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><a style="text-decoration: none"
                        href="?sort-by=name&sort-type={{ $sortType }}">Name</a></th>
                <th scope="col">Email</th>
                <th scope="col">Nhóm</th>
                <th scope="col">Kích hoạt</th>
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
                        <td>{{ $item->group_name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{!! $item->status == 0
                            ? '<button class="btn btn-sm btn-danger">Chưa kích hoạt</button>'
                            : '<button class="btn btn-sm btn-success">kích hoạt</button>' !!}</td>
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
