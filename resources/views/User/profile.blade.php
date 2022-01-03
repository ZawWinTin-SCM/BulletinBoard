@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endsection

@section('script')
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      Login
    </div>
    <div class="card-body">
      <div class="container clearfix">
        <div class="float-left col-sm-4">
          <img id="user-profile" src="/images/profile/{{ $user->profile }}" alt="Profile">
        </div>
        <div class="float-right col-sm-8">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Name</label>
            <label id="user-name"
              class="col-sm-8 col-form-label text-left text-danger font-italic">{{ $user->name }}</label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Type</label>
            <label id="user-type"
              class="col-sm-8 col-form-label text-left text-danger font-italic">{{ $user->type == 0 ? 'Admin' : 'User' }}</label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Email</label>
            <label id="user-email"
              class="col-sm-8 col-form-label text-left text-danger font-italic">{{ $user->email }}</label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Phone</label>
            <label id="user-phone"
              class="col-sm-8 col-form-label text-left text-danger font-italic">{{ $user->phone }}</label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Date of Birth</label>
            <label id="user-dob"
              class="col-sm-8 col-form-label text-left text-danger font-italic">{{ date('Y/m/d', strtotime($user->dob)) }}</label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Address</label>
            <label id="user-addr"
              class="col-sm-8 col-form-label text-left text-danger font-italic">{{ $user->address }}</label>
          </div>
          <div class="form-group row">
            <a href="/user/profile/edit" class="btn btn-primary">Edit Profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
