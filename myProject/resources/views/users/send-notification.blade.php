<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>send-notification</title>
</head>

<body>
    <div class="container mt-5">
        <h1>send-notification</h1>


        <div class="card mt-3 p-4 w-75 mx-auto">
            <h2>osamajanab9999@gmail.com</h2>
        @if(session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{route('sendNotificationToUser')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" class="form-control mt-3" autocomplete="off" placeholder="title">
                <input type="text" name="url" class="form-control mt-3" autocomplete="off" placeholder="url">
                <textarea cols="30" rows="5" name="body" class="form-control mt-3" autocomplete="off" placeholder="Message"></textarea>
                <input type="text" name="subject" class="form-control mt-3" autocomplete="off" placeholder="subject">
                <input type="file" name="myfiles[]" multiple class="form-control mt-3">
                <input type="submit" name="" value="Send Data" class="btn btn-danger mt-3">
            </form> 
            
        </div>


    </div>
    </div>


</body>

</html>