<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        .eye {
            float: right;
            margin-top: -30px;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    @extends("index")
    @section("content")
    <div class="container mt-5">
        <h1>login</h1>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card   p-3">
            <h5 class="card-title text-center">login Form</h5>
            <a href="{{route('sendEmail')}}">emailSend</a>
            <a href="/registerForm">register</a>
            <a href="/">home</a>
            <a href="/home">dashboard</a>
            <a href="{{route('sendDataView')}}">sendDataView</a>
            @if(session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('status')}}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{route('userLogin')}}" method="post" class="">
                @csrf
                <input type="text" name="email" class="form-control mt-3 " placeholder="Email">
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror

                <input type="password" name="password" id="password" class="form-control mt-3" placeholder="Password">

                <span class="eye"><i id="eyeId" class="fa-solid fa-eye "></i></span>

                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <br>
                <input type="checkbox" name="remember" class="mt-3" id="remember">
                <label for="remember" class="fw-bold">Remember Me</label> <br>
                <button type="submit" class="btn btn-primary mt-3">Login</button>
                <a href="/forgot-password">Forgot Password</a>
            </form>
        </div>
        </div>
        </div>
    </div>
    </div>

    <script>
        let eye = document.getElementById("eyeId");
        let pass = document.getElementById("password");

        eye.addEventListener("click", function() {
            if (pass.type === "password") {
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
                pass.type = "text";
            } else {
                eye.classList.add("fa-eye");
                eye.classList.remove("fa-eye-slash");
                pass.type = "password";
            }

        });
    </script>
    @endsection
</body>

</html>