@extends('layouts.app')

@section('content')

<div class="clearfix">
    <h2 class="float-left">My Profile</h2>
    <form action="{{ route('admin.allusers.update-profile',$user->id) }}" method="POST">
    @csrf
    @method('PUT')

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">


        <label for="email">email</label>
        <input type="text" class="form-control" name="email" id="name" value="{{$user->email}}">

        <label for="password">password</label>
        <input type="text" class="form-control" name="password" id="name" value="{{$user->password}}">

        <label for="password">role</label>
        <input type="text" class="form-control" name="password" id="name" value="{{$user->role}}">



        <br>
    <button class="btn btn-success">Update Profile</button>

    </form>
</div>

@endsection
