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
      Register Confirm
    </div>
    <div class="card-body text-center">
      <div class="register-container">
        <form method="post" id="userRegisterForm" action="/user/save" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-right">Name</label>
            <div class="col-sm-10">
              <input type="text" id="name" name="name" value="{{ $user->name }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label text-right">Email Address</label>
            <div class="col-sm-10">
              <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label text-right">Password</label>
            <div class="col-sm-10">
              <input type="password" id="password" name="password" value="{{ $user->password }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="confirmPwd" class="col-sm-2 col-form-label text-right">Confirm Password</label>
            <div class="col-sm-10">
              <input type="password" id="confirmPwd" name="confirmPwd" value="{{ $user->confirmPwd }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="type" class="col-sm-2 col-form-label text-right">Type</label>
            <div class="col-sm-10">
              <select class="form-select" id="type" name="type" disabled>
                @if ($user->type == 0)
                  <option value="0" selected>Admin</option>
                  <option value="1">User</option>
                @else
                  <option value="0">Admin</option>
                  <option value="1" selected>User</option>
                @endif
              </select>
              <input type="hidden" name="type" id="type" value="{{ $user->type }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label text-right">Phone</label>
            <div class="col-sm-10">
              <input type="tel" id="phone" name="phone" value="{{ $user->phone }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="dob" class="col-sm-2 col-form-label text-right">Date of Birth</label>
            <div class="col-sm-10">
              <input type="date" id="dob" name="dob" value="{{ $user->dob }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label text-right">Address</label>
            <div class="col-sm-10">
              <textarea name="address" id="address" readonly>{{ $user->address }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="profile" class="col-sm-2 col-form-label text-right">Profile</label>
            <div class="col-sm-10 text-left">
              <img src="{{ asset('/images/temp/' . $profileName) }}" alt="Profile Image" id="previewImg">
              <input type="hidden" name="profile" id="profile" value={{ $user->profile }}>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10 ml-auto text-left">
              <button type="submit" class="btn btn-primary">Confirm</button>
              <button type="button" class="btn btn-secondary" onclick="backRegisterProcess()">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
