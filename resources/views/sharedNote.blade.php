<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/converted.css') }}" rel="stylesheet">
    <title>Shared note</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @include('header')
        </div>
        <div class="row title-row d-flex justify-content-center align-items-center">
            <div class="col-12 text-center">
                <h1 class="page-title">{{ $note->name }}</h1>
            </div>
        </div>
        <div class="row note-row d-flex justify-content-center align-items-center">
            <div class="col-3"></div>
            <div class="col-6 text-center note-col">
                <div class="converted-note">
                    <p class="note-body">{{ $note->note }}</p>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <h3>Start converting Files</h3>
                @auth
                <span><a href="/">To convert page</a></span>
                @else
                <span><a>Login</a></span>
                @endauth
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</body>

</html>