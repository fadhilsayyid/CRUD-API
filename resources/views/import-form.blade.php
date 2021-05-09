<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</head>
<body>
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">Import</div>
                        
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" enctype="multipart/form-data" action="{{route('user.import')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Choose CSV</label>
                                    <input type="file" name="file" class="form-control" />
                                </div>
                                <button type="submit" class="btn btn-primary">Import</button>
                                <a class="btn btn-success" href="{{ url('userList')}}">User List</a>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>