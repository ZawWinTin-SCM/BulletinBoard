@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/user/profile_edit.css') }}">
@endsection

@section('script')
  <script src="{{ asset('js/user.js') }}"></script>
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      Profile Edit
    </div>
    <div class="card-body">
      <div class="container">
        <form method="post" action="/user/profile/edit" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-right label-required">Name</label>
            <div class="col-sm-10">
              <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label text-right label-required">Email Address</label>
            <div class="col-sm-10">
              <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="type" class="col-sm-2 col-form-label text-right label-required">Type</label>
            <div class="col-sm-10">
              <select class="form-select" id="type" name="type">
                @if ($user->type == 1 || $user->type == null)
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
            <label for="phone" class="col-sm-2 col-form-label text-right">Phone</label>
            <div class="col-sm-10">
              <input type="tel" id="phone" name="phone" value="{{ $user->phone }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="dob" class="col-sm-2 col-form-label text-right">Date of Birth</label>
            <div class="col-sm-10">
              <input type="date" id="dob" name="dob" value="{{ $user->dob }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label text-right">Address</label>
            <div class="col-sm-10">
              <textarea name="address" id="address">{{ $user->address }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="old-profile" class="col-sm-2 col-form-label text-right">Old Profile</label>
            <div class="col-sm-10">
              <img id="old-profile" src="/images/profile/{{ $user->profile }}" alt="Old Profile">
            </div>
          </div>
          <div class="form-group row">
            <label for="profile" class="col-sm-2 col-form-label text-right">New Profile</label>
            <div class="col-sm-10">
              <input type="file" name="profile" class="form-control-file" id="profile">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10 ml-auto text-left">
              <input type="submit" class="btn btn-primary" value="Edit">
              <button type="button" onclick="clearEditFormData()" class="btn btn-secondary">Clear</button>
              <a href="/user/change-password" class="ml-2">Change Password</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
