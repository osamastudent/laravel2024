<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>register</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Register</h1>
        @if(session('email'))
{{session('email')}}
</div>
@endif

@if(session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

        <div class="card w-50 mx-auto p-3">
            <h5 class="card-title">Registeration Form</h5>
            @if(session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{route('userRegister')}}" method="post" enctype="multipart/form-data" class="">
                @csrf
                <input type="text" name="name" class="form-control mt-3" placeholder="Name">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <input type="text" name="email" class="form-control mt-3" placeholder="Email">
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <input type="file" name="image" class="form-control mt-3" placeholder="image">
                @error('image')
                <p class="text-danger">{{$message}}</p>
                @enderror

                <input type="text" name="password" class="form-control mt-3" placeholder="Password">
                <button type="submit" class="btn btn-primary mt-3">Add Users</button>
            </form>
        </div>

       </div>


</body>

</html>
