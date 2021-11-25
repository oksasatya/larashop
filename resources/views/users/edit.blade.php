@extends('layouts.global')
@section('title')
    Edit User
@endsection
@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('users.update', [$user->id]) }}" method="post">
            @csrf
            <input type="hidden" value="PUT" name="_method">

            <input type="text" name="name" placeholder="FullName" class="form-control" value="{{ $user->name }}"
                id="name">

            <label for="status">status</label>
            <br>
            <input {{ $user->status == 'ACTIVE' ? 'checked' : '' }} value="ACTIVE" type="radio" class="form-control"
                id="active" name="status">
            <label for="active">Active</label>

            <input type="radio" {{ $user->status == 'INACTIVE' ? 'checked' : '' }} value="INACTIVE" class="form-control"
                id="inactive" name="status">
            <label for="inactive">Inactive</label>
            <br><br>

            <input type="checkbox" {{ in_array('ADMIN', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                id="ADMIN" value="ADMIN">
            <label for="ADMIN">Administrator</label>


            <input type="checkbox" {{ in_array('STAFF', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                id="STAFF" value="STAFF">
            <label for="STAFF">Staff</label>

            <input type="checkbox" {{ in_array('CUSTOMER', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                id="CUSTOMER" value="CUSTOMER">
            <label for="CUSTOMER">Customer</label>

            <br>
            <br>
            <label for="phone">Phone Number</label>
            <br>
            <input type="text" name='phone' class="form-control" value="{{ $user->phone }}">
            <br>

            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control">{{ $user->address }}</textarea>
            <br>

            <label for="avatar">Avatar Image</label>
            <br>
            Current avatar: <br>
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" width="120px">
                <br>
            @else
                No Avatar
            @endif
            <br>
            <input id="avatar" name="avatar" type="file" class="form-control">
            <small class="text-muted">Kosongkan Jika tidak ingin mengubah avatar</small>


            <hr class="my-3">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" disabled
                placeholder="user@gmail.com">
            <br>

            <input type="submit" class="btn btn-primary" value="save">
        </form>

    </div>

@endsection
