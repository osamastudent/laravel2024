<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>trash</title>
</head>

<body>
    <div class="container mt-5">
        
    @if(session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        
        <div class="card w-75 mx-auto mt-5 p-3">
            <h1 class=" text-center card-title">trash records</h1>
            <a href="/login">login</a>
            <a href="/logout">logout</a>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        
<form action="/selectidsforrestore" method="post">
    @csrf;
                        @if($show)
                        @foreach($show as $values)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$values->name}}</td>
                            <td>{{$values->email}}</td>
                            <td><a href="/restore/{{$values->id}}">restore</a>
                        &nbsp; <input type="checkbox" name="ids[]" value="{{$values->id}}" id="selectid{{$loop->index}}"> <label for="selectid{{$loop->index}}">restore</label>
                        </td>
                        
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td><button type="submit" class="btn btn-warning">restore</button></td>
                            <td><a href="/restoreall" class="btn btn-danger">Restore All</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="file" class="form-control" id="input-image" name="userimage"><br>
    <img src="" id="preview-image" height="200">

    <script>
     var inputimg = document.getElementById("input-image");
    var previewimg = document.getElementById("preview-image");
    inputimg.addEventListener("change", function(event) {
        if (event.target.files.length === 0) {
            return;
        } else {
            const file = event.target.files[0];
            var tmpUrl = URL.createObjectURL(event.target.files[0]);
            previewimg.setAttribute("src", tmpUrl);
        }
    });
</script>
        </div>
    </div>


</body>

</html>