@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/post/createUpdateForm.css') }}">
@endsection

@section('script')
@endsection

@section('content')
<div class="card mt-5">
  <div class="card-header">
    Post Edit
  </div>
  <div class="card-body text-center">
    <div class="container">
      <form method="post" action="/post/update/{{ $id }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label text-right label-required">Title</label>
          <div class="col-sm-10">
            <input type="text" id="title" name="title" value="{{ $post->title }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label text-right label-required">Description</label>
          <div class="col-sm-10">
            <textarea name="description" id="description" readonly>{{ $post->description }}</textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class="col-sm-2 col-form-label text-right">Status</label>
          <div class="col-sm-10 text-left">
            <label class="switch mx-auto">
              <input type="checkbox" disabled="true" {{($post->status == 'on')? 'checked' : '' }}>
              <span class="slider round"></span>
              <input type="hidden" id="status" name="status" value="{{($post->status == 'on')? '1' : '0' }}">
            </label>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 ml-auto text-left">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <a href="/post/edit/{{ $id }}" class="btn btn-secondary">Cancel</a>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection