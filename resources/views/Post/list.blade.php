@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('css/post/list.css') }}">
@endsection

@section('script')
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('js/post.js') }}"></script>
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      Post List
    </div>
    <div class="card-body">
      <div class="container">
        @if (session('message'))
          <div class="alert alert-success">
            <strong>{{ session('message') }}</strong>
          </div>
        @endif
        <div class="custom-btn-list text-right">
          <label for="search">Keyword:</label>
          <input type="text" name="search" id="search">
          <button type="button" onclick="searchPosts()" class="btn btn-primary">Search</button>
          @auth
            <a href="/post/create" class="btn btn-primary">Create</a>
            <a href="/post/upload" class="btn btn-primary">Upload</a>
            <a href="/post/download" class="btn btn-primary">Download</a>
          @endauth
        </div>
        <table id="postTable" class="table table-striped">
          <thead>
            <tr>
              <th>Post Title</th>
              <th>Post Description</th>
              <th>Posted User</th>
              <th>Posted Date</th>
              @auth
                <th>Operation</th>
              @endauth
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
              <tr>
                <td>
                  <button onclick="showPostDetail({{ $post->id }})" class="title-btn text-warning" data-toggle="modal"
                    data-target="#postDetailModal">{{ $post->title }}</button>
                </td>
                <td>{{ $post->description }}</td>
                <td>
                  @foreach ($users as $user)
                    @if ($user->id == $post->created_user_id)
                      {{ $user->name }}
                    @endif
                  @endforeach
                </td>
                <td>{{ date('Y/m/d', strtotime($post->created_at)) }}</td>
                @auth
                  <td>
                    <a class="btn btn-info" href="/post/edit/{{ $post->id }}">Edit</a>
                    <button onclick="showDeleteConfirmModal({{ $post->id }})" class="btn btn-danger" data-toggle="modal"
                      data-target="#postDeleteConfirmModal">Delete</button>
                  </td>
                @endauth
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Post Detail Modal -->
  <div class="modal fade" id="postDetailModal" tabindex="-1" role="dialog" aria-labelledby="postDetailModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Post Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Title</label>
            <label id="post-title" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Description</label>
            <label id="post-description" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Status</label>
            <label id="post-status" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Created Date</label>
            <label id="created-date" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Created User</label>
            <label id="created-user" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Updated Date</label>
            <label id="updated-date" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-left">Updated User</label>
            <label id="updated-user" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Post Delete Confirm Modal -->
  <div class="modal fade" id="postDeleteConfirmModal" tabindex="-1" role="dialog"
    aria-labelledby="postDeleteConfirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Confirm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-title">Are you sure to delete post?</h4>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-left">ID</label>
            <label id="post-id" class="col-sm-9 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-left">Title</label>
            <label id="post-title" class="col-sm-9 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-left">Description</label>
            <label id="post-description" class="col-sm-9 col-form-label text-left text-danger font-italic"></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-left">Status</label>
            <label id="post-status" class="col-sm-9 col-form-label text-left text-danger font-italic"></label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="" class="btn btn-danger" id="deleteBtn">Delete</a>
        </div>
      </div>
    </div>
  </div>
@endsection
