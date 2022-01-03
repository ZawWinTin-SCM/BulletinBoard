@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/post/createUpdateForm.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/post.js') }}"></script>
@endsection

@section('content')
<div class="card mt-5">
  <div class="card-header">
    Create Post
  </div>
  <div class="card-body text-center">
    <div class="container">
      <form id="postCreateForm" method="post" action="/post/save" enctype="multipart/form-data">
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
          <div class="col-sm-10 ml-auto text-left">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" class="btn btn-secondary" onclick="backCreateProcess()">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection