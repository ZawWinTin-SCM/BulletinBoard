@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/auth.js') }}"></script>
@endsection

@section('content')
<div class="card mt-5">
  <div class="card-header">
    Login
  </div>
  <div class="card-body text-center">
    <div class="container">
      <form method="post" action="/auth/login" class="user-form" enctype="multipart/form-data">
        @csrf
        @error('email')
        <div class="alert alert-danger">
          <strong>{{ $message }}</strong>
        </div>
        @enderror        
        @error('password')
        <div class="alert alert-danger">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label text-right">Email Address</label>
          <div class="col-sm-10">
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label text-right">Password</label>
          <div class="col-sm-10">
            <input type="password" id="password" name="password" value="" required>
          </div>
        </div>
        <div class="form-group row ml-2">
          <div class="col-sm-10 ml-auto text-left">
            <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe" value="false">
            <label class="form-check-label" for="rememberMe">
              Remember Me
            </label>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 ml-auto text-left">
            <input type="submit" class="btn btn-primary mr-3" value="Login">
            <a href="/forget-password">Forgot Your Password?</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection