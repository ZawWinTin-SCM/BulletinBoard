@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/user/createForm.css') }}">
@endsection

@section('script')
  <script src="{{ asset('js/user.js') }}"></script>
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      Register
    </div>
    <div class="card-body text-center">
      <div class="register-container">
        <form method="post" action="/user/create/confirm" enctype="multipart/form-data">
          @csrf
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <strong>{{ $error }}</strong><br>
                @endforeach
            </div>
          @endif
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label text-right">Name</label>
            <div class="col-sm-9">
              <input type="text" id="name" name="name" value="{{ $user->name ?? old('name') }}">
            </div>
          </div>          
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label text-right">Email Address</label>
            <div class="col-sm-9">
              <input type="email" id="email" name="email" value="{{ $user->email ?? old('email') }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label text-right">Password</label>
            <div class="col-sm-9">
              <input type="password" id="password" name="password" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="confirmPwd" class="col-sm-3 col-form-label text-right">Confirm Password</label>
            <div class="col-sm-9">
              <input type="password" id="confirmPwd" name="confirmPwd" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="type" class="col-sm-3 col-form-label text-right">Type</label>
            <div class="col-sm-9">
              <select class="form-select" id="type" name="type">
                @if (($user->type ?? old('type')) == 1 || ($user->type ?? old('type')) == null)
                  <option value="0">Admin</option>
                  <option value="1" selected>User</option>
                @else
                  <option value="0" selected>Admin</option>
                  <option value="1">User</option>
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="phone" class="col-sm-3 col-form-label text-right">Phone</label>
            <div class="col-sm-9">
              <input type="tel" id="phone" name="phone" value="{{ $user->phone ?? old('phone') }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="dob" class="col-sm-3 col-form-label text-right">Date of Birth</label>
            <div class="col-sm-9">
              <input type="date" id="dob" name="dob" value="{{ $user->dob ?? old('dob') }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
            <div class="col-sm-9">
              <textarea name="address" id="address">{{ $user->address ?? old('address') }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="profile" class="col-sm-3 col-form-label text-right">Profile</label>
            <div class="col-sm-9">
              <input type="file" name="profile" class="form-control-file" id="profile"
                value={{ $user->profile ?? old('profile') }}>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-9 ml-auto text-left">
              <input type="submit" class="btn btn-primary" value="Register">
              <button type="button" onclick="clearCreateFormData()" class="btn btn-secondary">Clear</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
