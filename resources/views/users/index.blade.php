@extends('layouts.global')
@section('title')@endsection
@section('content')
    Daftar User disini


    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>

    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Username</b></th>
                <th><b>Email</b></th>
                <th><b>Avatar</b></th>
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
                        <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-info text-white btn-sm">edit</a>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        <form action="post" action="{{ route('users.destroy', [$user->id]) }} "
                            onsubmit="return confirm('Delete this user permanently?')" class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
