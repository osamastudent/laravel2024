<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>send-data-viewa</title>
</head>

<body>
    <div class="container mt-5">
        <h1>send-data-viewa</h1>

    <div class="card mt-3 p-4 w-75 mx-auto">
    <img src="{{asset('classphoto.jpg')}}" alt="" class="card-img-top" height="200">
  <div class="card-body">
    <h5 class="card-title">{{$subject}}</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">{{$body}}</p>
    <a href="#" class="card-link">{{$name}}</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
      
        </div>



</div>


</body>

</html>