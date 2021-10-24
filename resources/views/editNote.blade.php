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
        <div class="row title-row-edit d-flex justify-content-center align-items-center">
            <div class="col-12 text-center">
                <h1 class="page-title">Edit note</h1>
            </div>
        </div>
        <div class="row note-row d-flex justify-content-center align-items-center">
            <div class="col-3"></div>
            <div class="col-6 text-center note-col">
                <div class="converted-note">
                    <form method="POST" action="{{ $note->id }}" id="edit-note-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-outline mb-4">
                            <label for="noteTitle" class="edit-label">Note title</label>
                            <input type="text" class="form-control" name="noteTitle" id="noteTitle" class="noteTitle" value="{{ old('noteTitle', $note->name) }}" required><br>

                            <label for="noteBody" class="edit-label">Note</label>
                            <textarea class="noteBody w-100" id="noteBody" rows="10" name="noteBody">
                                {{ $note->note }}
                            </textarea><br><br>

                            <label for="shareLink" class="edit-label">Custom share link</label>
                            <input type="text" id="shareLink" class="form-control" name='shareLink' class="shareLink" value="{{ old('sharelink', $note->share_link) }}" required><br>

                            <input type="submit" class="submit" name="submit">

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>