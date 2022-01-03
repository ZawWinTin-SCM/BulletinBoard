<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lib/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common/app.css') }}">
  @yield('style')

  <!-- Script -->
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
  <script src="{{ asset('js/lib/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/lib/fontawesome.js') }}"></script>
  <script src="{{ asset('js/lib/moment.js') }}"></script>
  @yield('script')

  <title>BulletinBoard</title>
</head>

<body>
  <!-- navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="/post/list">BulletinBoard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/user/list">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/post/list">Posts</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/user/create">Create User</a>
          </li>          
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/user/profile">Profile</a>
              <a class="dropdown-item" href="/auth/logout">Log out</a>
            </div>
          </li>
          @endauth
          @guest
          <li class="nav-item">
            <a class="nav-link" href="/auth/login">Login</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mb-3">
    @yield('content')
  </div>
</body>

</html>