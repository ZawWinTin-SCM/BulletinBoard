@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/user/password_change.css') }}">
@endsection

@section('script')
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      Change Password
    </div>
    <div class="card-body text-center">
      <div class="container">
        <form method="post" action="/user/change-password" enctype="multipart/form-data">
          @csrf
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <strong>{{ $error }}</strong><br>
                @endforeach
            </div>
          @endif
          <div class="form-group row">
            <label for="currentPwd" class="col-sm-3 col-form-label text-right">Current Password</label>
            <div class="col-sm-9">
              <input type="password" id="currentPwd" name="currentPwd" required>
            </div>
          </div>          
          <div class="form-group row">
            <label for="newPwd" class="col-sm-3 col-form-label text-right">New Password</label>
            <div class="col-sm-9">
              <input type="password" id="newPwd" name="newPwd" required>
            </div>
          </div>          
          <div class="form-group row">
            <label for="new-confirm-pwd" class="col-sm-3 col-form-label text-right">New Confirm Password</label>
            <div class="col-sm-9">
              <input type="password" id="newConfirmPwd" name="newConfirmPwd" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-9 ml-auto text-left">
              <input type="submit" class="btn btn-primary" value="Update Password">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
