<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>reset-password</title>
</head>

<body>
    <div class="container mt-5">
        <h1>reset-password</h1>

        
        <div class="card mt-3 p-4 w-75 mx-auto">
            @if(session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">           
{{session('status')}}
            
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
            <form action="{{route('password.update')}}" method="post" class="">
                @csrf
                <input type="text" name="email" class="form-control mt-3" placeholder="Email">
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <input type="hidden" name="token" value="{{$token}}">

                <input type="text" name="password" class="form-control mt-3" placeholder="Password">
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <input type="text" name="password_confirmation" class="form-control mt-3" placeholder="Confirm Password">
                @error('password_confirmation')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <button type="submit" class="btn btn-primary mt-3">Reset password</button>
            </form>
        </div>

    
        </div>
    </div>


</body>

</html>