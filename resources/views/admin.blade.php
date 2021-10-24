<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <title>Admin panel</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @include('header')
        </div>


        <div class="row title-row-admin d-flex align-items-center">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <h1>Admin panel</h1>
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row title-row-api">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <h2>Api usage</h2>
                <span>Requests: {{ $apiData->quota }}/1000 Since {{ $apiData->date_check }}</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ $apiData->quota/10 }}%" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <h2>Manage admins</h2>
                <table class="table admins-table">
                    <thead>
                        <tr>
                            <th class="admins-th" scope="col">#</th>
                            <th class="admins-th" scope="col">Name</th>
                            <th class="admins-th" scope="col">Registered since</th>
                            <th class="admins-th" scope="col">Change permission</th>
                            <th class="admins-th" scope="col">Delete admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <th scope="row">{{ $admin->id }}</th>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->created_at }}</td>
                                <td><button type="button" class="btn btn-dark"><a class="link"
                                            href="{{ url('/make-user', [$admin->id]) }}">Change to normal
                                            user</a></button></td>
                                <td><button type="button" class="btn btn-dark"><a class="link"
                                            href="{{ url('/delete-user', [$admin->id]) }}">Delete</a></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="admins-pagination">
                {{ $admins->links() }}
            </div>
        </div>


        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <h2>Manage users</h2>
                    </div>
                    <div class="col-3">
                        <div class="container">
                            <form action="/search" method="get" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="results" placeholder="Search users">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table users-table">
                    <thead>
                        <tr>
                            <th class="users-th" scope="col">#</th>
                            <th class="users-th" scope="col">Name</th>
                            <th class="users-th" scope="col">Registered since</th>
                            <th class="users-th" scope="col">View notes</th>
                            <th class="users-th" scope="col">Change permission</th>
                            <th class="users-th" scope="col">Delete user</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td><button type="button" class="btn btn-dark"><a class="link"
                                            href="{{ url('/admin-notes', [$user->id]) }}">View notes</a></button>
                                </td>
                                <td><button type="button" class="btn btn-dark"><a class="link"
                                            href="{{ url('/make-admin', [$user->id]) }}">Make admin</a></button>
                                </td>
                                <td><button type="button" class="btn btn-dark"><a class="link"
                                            href="{{ url('/delete-user', [$user->id]) }}">Delete</a></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="users-pagination">
                    {{ $users->links() }}
                </div>
            </div>
            <div class="col-2"></div>
        </div>


        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <h2>5 Latest notes</h2>
                <table class="table users-table">
                    <thead>
                        <tr>
                            <th class="users-th" scope="col">#</th>
                            <th class="users-th" scope="col">Name</th>
                            <th class="users-th" scope="col">Note</th>
                            <th class="users-th" scope="col">Share link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestNotes as $latestNote)
                            <tr>
                                <th scope="row">{{ $latestNote->id }}</th>
                                <td>{{ $latestNote->name }}</td>
                                <td>{{ Str::limit($latestNote->note, 200) }}...</td>
                                <td>{{ $latestNote->share_link }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>

</html>
