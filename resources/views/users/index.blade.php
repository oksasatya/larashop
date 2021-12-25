@extends('layouts.global')
@section('title')@endsection
@section('content')
    Daftar User disini


    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>

    @endif
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('users.index') }}">
                <div class="input-group">
                    <input type="text" name="keyword" placeholder="Masukkan email untuk filter" class="form-control"
                        value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ Request::get('status') == null && Request::path() == 'users' ? 'active' : '' }}">All</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index', ['status' => 'active']) }}"
                        class="nav-link {{ Request::get('status') == 'active' ? 'active' : '' }}">active</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index', ['status' => 'inactive']) }}"
                        class="nav-link {{ Request::get('status') == 'inactive' ? 'active' : '' }}">inactive</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
        </div>
    </div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Username</b></th>
                <th><b>Email</b></th>
                <th><b>Avatar</b></th>
                <th><b>Status</b></th>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" width="70px" />
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($user->status == 'ACTIVE')
                            <span class="badge badge-success">
                                {{ $user->status }}
                            </span>

                        @else
                            <span class="badge badge-danger">
                                {{ $user->status }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-info text-white btn-sm">edit</a>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        <form method="POST" action="{{ route('users.destroy', [$user->id]) }} "
                            onsubmit="return confirm('Delete this user permanently?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <tfoot>
        <tr>
            <td colspan=10>
                {{ $users->appends(Request::all())->links() }}
            </td>
        </tr>
    </tfoot>
@endsection
