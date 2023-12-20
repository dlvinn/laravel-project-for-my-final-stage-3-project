@extends('layouts.app')

@section('content')

<div class="clearfix">
    <h2 class="float-left">List of all Users</h2>

    {{-- link to create new post --}}
    <a href="{{ route('posts.create') }}" class="btn btn-link float-right"> Add new user</a>
</div>

{{-- List all posts --}}
<table class="table">

  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">password</th>
      <th scope="col">role</th>
      <th scope="col">crud operations</th>
    </tr>
  </thead>
@forelse ($users as $user)

  <tbody>
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->password}}</td>
      <td>{{$user->role}}</td>
      <td><a href="{{url('admin/allusers/delete', $user->id)}}">delete</a>
         <a href="{{url('admin/allusers/edit/profile',$user->id)}}">edit</a></td>
    </tr>
  </tbody>
@empty
    <p>No posts yet, stay tuned!</p>
@endforelse
</table>


@endsection
