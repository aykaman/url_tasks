<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Url download app</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="container">

                    <div class="row">

                        <div class="col-lg-12">

                            <h1 class="mt-4">Task List</h1>

                            <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Url address</th>
                                    <th>Status</th>
                                    <th>Local path</th>
                                    <th>Created Time</th>
                                    <th>Updated Time</th>
                                </tr>

                                @if(count($urlTasks) == 0)
                                    <tr>
                                        <td colspan="6">No tasks available</td>
                                    </tr>
                                @endif

                                @foreach ($urlTasks as $urlTask)
                                    <tr>
                                        <td>{{ $urlTask->id }}</td>
                                        <td>{{ $urlTask->url }}</td>
                                        <td>{{ $urlTask->status }}</td>
                                        <td>
                                            @if($urlTask->local_path)
                                                <a href="{{ $urlTask->local_path }}">Download</a>
                                            @endif
                                        </td>
                                        <td>{{ $urlTask->created_at }}</td>
                                        <td>{{ $urlTask->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="card my-4">
                                <h5 class="card-header">Enqueue task:</h5>
                                <div class="card-body">
                                    <form method="post" action="">

                                        @csrf

                                        <div class="form-group">
                                            <input type="text" name="url" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
