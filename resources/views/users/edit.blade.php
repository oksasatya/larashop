@extends('layouts.global')
@section('title')
    Edit User
@endsection

<form action="{{ route('users.update', [$user->id]) }}" method="post">
    @csrf
    <input type="hidden" value="PUT" name="_method">

    <input type="text" name="name" placeholder="FullName" class="form-control" value="{{ $user->name }}" id="name">

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
</form>
