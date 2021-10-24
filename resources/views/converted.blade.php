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
    <title>Converted note</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @include('header')
        </div>
        <div class="row title-row d-flex justify-content-center align-items-center">
            <div class="col-12 text-center">
                <h1 class="page-title">Your converted note<h1>
            </div>
        </div>
        <div class="row note-row d-flex justify-content-center align-items-center">
            <div class="col-3"></div>
            <div class="col-6 text-center note-col">
                <div class="converted-note">
                    <h5 class="note-title">{{ $noteTitle }}</h5>
                    <p class="note-body">{{ $noteBody }}</p>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <h3>Share file</h3>
                @auth
                @php $baseUrl = $_SERVER['SERVER_NAME'] @endphp
                <span>Copy link to share file: {{ $baseUrl }}/shared-file/{{ $shareLink }}</span>
                @else
                <span><a>Login</a> to share file</span>
                @endauth
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</body>

</html>
