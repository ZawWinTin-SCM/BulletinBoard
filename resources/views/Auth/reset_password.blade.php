@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/auth/reset_password.css') }}">
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
        <form method="post" action="{{ route('reset.password.post') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="email" name="email" value = "{{ $email }}">
          <input type="hidden" id="token" name="token" value="{{ $token }}">
          @error('newPassword')
            <div class="alert alert-danger">
              <strong>{{ $message }}</strong>
            </div>
          @enderror          
          @error('confirmPassword')
            <div class="alert alert-danger">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
          <div class="form-group row">
            <label for="newPassword" class="col-sm-3 col-form-label text-right">New Password</label>
            <div class="col-sm-9">
              <input type="password" id="newPassword" name="newPassword" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="new-confirm-pwd" class="col-sm-3 col-form-label text-right">New Confirm Password</label>
            <div class="col-sm-9">
              <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10 ml-auto text-left">
              <input type="submit" class="btn btn-primary" value="Reset Password">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
