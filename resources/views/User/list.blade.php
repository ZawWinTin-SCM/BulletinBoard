@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('css/user/list.css') }}">
@endsection

@section('script')
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('js/user.js') }}"></script>
@endsection

@section('content')
  <div class="card mt-5">
    <div class="card-header">
      User List
    </div>
    <div class="card-body">
      <div class="container">
        @if (session('message'))
          <div class="alert alert-success">
            <strong>{{ session('message') }}</strong>
          </div>
        @endif
        <div class="custom-search-list text-right mb-2">
          <label for="searchName">Name:</label><input type="text" name="searchName" id="searchName">
          <label for="searchEmail">Email:</label><input type="text" name="searchEmail" id="searchEmail">
          <label for="fromDate">From:</label><input type="date" name="fromDate" id="fromDate">
          <label for="toDate">To:</label><input type="date" name="toDate" id="toDate">
          <button type="button" onclick="searchUsers()" class="btn btn-primary">Search</button>
        </div>
        <table id="userTable" class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Created User</th>
              <th>Type</th>
              <th>Phone</th>
              <th>Date of Birth</th>
              <th>Address</th>
              <th>Created Date</th>
              <th>Updated Date</th>
              @auth
                <th>Operation</th>
              @endauth
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>
                  <button onclick="showUserDetail({{ $user->id }})" class="title-btn text-warning" data-toggle="modal"
                    data-target="#userDetailModal">{{ $user->name }}</button>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                  @foreach ($users as $createdUser)
                    @if ($createdUser->id == $user->created_user_id)
                      {{ $createdUser->name }}
                    @endif
                  @endforeach
                </td>
                <td>{{ $user->type == 0 ? 'Admin' : 'User' }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ date('Y/m/d', strtotime($user->dob)) }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ date('Y/m/d', strtotime($user->created_at)) }}</td>
                <td>{{ date('Y/m/d', strtotime($user->updated_at)) }}</td>
                @auth
                  <td>
                    <button onclick="showDeleteConfirmModal({{ $user->id }})" class="btn btn-danger" data-toggle="modal"
                      data-target="#userDeleteConfirmModal">Delete</button>
                  </td>
                @endauth
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- User Detail Modal -->
  <div class="modal fade" id="userDetailModal" tabindex="-1" role="dialog" aria-labelledby="userDetailModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="clearfix">
            <div class="float-left col-sm-4">
              <img id="user-profile" src="" alt="Profile">
            </div>
            <div class="float-right col-sm-8">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-left">Name</label>
                <label id="user-name" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-left">Type</label>
                <label id="user-type" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-left">Email</label>
                <label id="user-email" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-left">Phone</label>
                <label id="user-phone" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-left">Date of Birth</label>
                <label id="user-dob" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-left">Address</label>
                <label id="user-addr" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
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
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- User Delete Confirm Modal -->
  <div class="modal fade" id="userDeleteConfirmModal" tabindex="-1" role="dialog"
    aria-labelledby="userDeleteConfirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Confirm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4 class="modal-title">Are you sure to delete user?</h4>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-left">ID</label>
              <label id="user-id" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-left">Name</label>
              <label id="user-name" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-left">Type</label>
              <label id="user-type" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-left">Email</label>
              <label id="user-email" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-left">Phone</label>
              <label id="user-phone" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-left">Date of Birth</label>
              <label id="user-dob" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-left">Address</label>
              <label id="user-addr" class="col-sm-8 col-form-label text-left text-danger font-italic"></label>
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
