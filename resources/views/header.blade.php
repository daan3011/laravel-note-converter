<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <title>Navbar</title>
</head>
<body>
    <nav class="navbar navbar-dark navbar-color nav-fill w-100 navbar-expand-sm">
        <a class="navbar-brand" href="#">
          <img src="https://www.svgrepo.com/show/260479/notes-notepad.svg" width="30" height="30" class="d-inline-block align-top" alt="">
          Note converter
        </a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">
                  Convert note
                </a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" href="/profile">
                  My notes
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/logout') }}">
                Logout
              </a>
          </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="/login">
                Login
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">
              Register
            </a>
        </li>
            @endauth
      </nav>
</body>
</html>