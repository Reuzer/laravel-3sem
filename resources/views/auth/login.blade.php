@extends('layout')

@section('content')
@if($errors->any())
  @foreach($errors->all() as $error)
    <div class="alert-danger">{{$error}}</div>
  @endforeach
@endif
<form method="POST" action="/auth/authenticate" class="mt-4">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name='email' id="email" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" name="remember" id="remember" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary">Sign In</button>
  </form>
@endsection