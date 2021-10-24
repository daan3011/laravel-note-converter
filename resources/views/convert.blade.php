<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/convert.css') }}" rel="stylesheet">


    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @include('header')
        </div>
        <div class="row title-row align-items-end">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <h1>Convert note</h1>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <form method="POST" action="" id="add-note-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" class="form-control" name='noteTitle' id="noteTitle" class="noteTitle" value='' placeholder="Note title" required><br>
                        
                        <h4>Select the image with the text to convert </h4>
                        <input type="file" name='noteImg' id="noteImg" class="noteImg" value='' required><br>
                        <input class="submit" type="submit" name="submit" value="Convert note">
                    </div>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row introduction-row">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <h2>What is note Converter?</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat libero ante, et dapibus odio pharetra ac. 
                    Nullam tincidunt sit amet enim eu viverra. Proin accumsan arcu lobortis, lacinia augue in, sagittis magna. Vestibulum lobortis
                    vehicula arcu, non sodales erat tempor sed. Curabitur imperdiet, felis ut scelerisque posuere, leo tortor vestibulum purus, viverra
                    commodo quam mauris in tortor. Integer pellentesque neque quis augue vehicula luctus. Nulla ut elit tempus, volutpat magna eu, venenatis
                    justo. Sed maximus, risus ac feugiat facilisis, urna eros tincidunt dui, sed condimentum sem felis eget dolor. Ut ante nulla, mattis ut velit id,
                    semper egestas orci.
                </p>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>
