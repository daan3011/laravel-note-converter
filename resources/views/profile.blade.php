<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" >
</head>

<body>
    <div class="container-fluid">
        <div class="row">
                @include('header')
        </div>
        <div class="row title-row d-flex justify-content-center align-items-center">
            <div class="col-12">
                <h1 class="text-center">My notes</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                @foreach ($notes as $note)
                    <div class="note-div d-flex justify-content-between align-items-center">
                        <h4 class="note-title">{{ $note->name }}</h4>
                        <div class="note-div-bttns">
                        <button type="button" class="btn btn-default note-ctrl-bttn"><a class="link" href="{{ url('/view-note', [$note->id]) }}">View</a></button>
                        <button type="button" class="btn btn-default note-ctrl-bttn"><a class="link" href="{{ url('/edit-note', [$note->id]) }}">Edit</a></button>
                        <button type="button" class="btn btn-default note-ctrl-bttn"><a class="link" href="{{ url('/delete-note', [$note->id]) }}">Delete</a></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-2"></div>
        </div>
</body>

</html>
