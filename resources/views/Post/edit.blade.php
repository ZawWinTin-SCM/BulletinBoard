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
      Post Edit
    </div>
    <div class="card-body text-center">
      <div class="container">
        <form method="post" action="/post/edit/confirm/{{ $post->id }}" enctype="multipart/form-data">
          @csrf
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                <strong>{{ $error }}</strong><br>
              @endforeach
            </div>
          @endif
          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label text-right label-required">Title</label>
            <div class="col-sm-10">
              <input type="text" id="title" name="title" value="{{ $post->title }}" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label text-right label-required">Description</label>
            <div class="col-sm-10">
              <textarea name="description" id="description" required>{{ $post->description }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label text-right">Status</label>
            <div class="col-sm-10 text-left">
              <label class="switch mx-auto">
                <input type="checkbox" id="status" name="status" {{ $post->status == 1 ? 'checked' : '' }}>
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10 ml-auto text-left">
              <input type="submit" class="btn btn-primary" value="Edit">
              <button type="button" onclick="clearFormData()" class="btn btn-secondary">Clear</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
