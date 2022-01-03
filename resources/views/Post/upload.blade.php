@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/post/upload.css') }}">
@endsection

@section('script')
  <script src="{{ asset('js/post.js') }}"></script>
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      Upload CSV File
    </div>
    <div class="card-body text-center">
      <div class="container">
        <form method="post" action="/post/upload" enctype="multipart/form-data">
          @csrf
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <strong>{{ $error }}</strong><br>
                @endforeach
            </div>
          @endif
          <div class="form-group row">
            <label for="postFile" class="col-sm-2 col-form-label text-right">CSV File</label>
            <div class="col-sm-10">
              <input type="file" name="postFile" class="form-control-file" id="postFile">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10 ml-auto text-left">
              <input type="submit" class="btn btn-primary" value="Upload">
              <button type="button" onclick="clearFile()" class="btn btn-secondary">Clear</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
@endsection
