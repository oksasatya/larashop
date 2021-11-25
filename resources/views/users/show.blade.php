@extends('layouts.global')
@section('title')
    Detail User

@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <b>name:</b><br>
                {{ $user->name }}
                <br>
                <br>

                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }} " width="120px">

                @else
                    No Avatar
                @endif
                <br>
                <br>
                <b>username</b><br>
                {{ $user->email }}
                <br>
                <br>
                <b>Phone Number</b>
                {{ $user->phone }}
                <br>
                <br>

                <b>address</b><br>
                {{ $user->address }}
                <br>
                <br>

                <b>roles</b><br>
                @foreach (json_decode($user->role) as $role)
                    &middot; {{ $role }}<br>
                @endforeach
            </div>
        </div>
    </div>

@endsection
