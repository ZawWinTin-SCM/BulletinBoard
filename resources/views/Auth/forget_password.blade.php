@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/auth/forget_password.css') }}">
@endsection

@section('script')
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      Reset Password
    </div>
    <div class="card-body text-center">
      <div class="container">
        <form method="post" action="{{ route('forget.password.post') }}" enctype="multipart/form-data">
          @csrf
          @error('email')
            <div class="alert alert-danger">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
          @if (session('message'))
            <div class="alert alert-success">
              <strong>{{ session('message') }}</strong>
            </div>
          @endif
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label text-right">Email Address</label>
            <div class="col-sm-10">
              <input type="email" id="email" name="email" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10 ml-auto text-left">
              <input type="submit" class="btn btn-primary" value="Send Password Reset Link">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
