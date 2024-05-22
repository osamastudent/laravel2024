<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>post view</title>
    <style>
        .card-text {
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            display: -webkit-box;
            /* text-overflow: ellipsis; */

        }
    </style>
</head>

<body>
    <div class="container mt-5">

        <div class="row">
            @foreach($postByCategorView->postBelongs as $values)
            <div class="col-4">
             <a href="{{url('see-post/'.$values->id)}}" class="text-decoration-none text-dark">
             <div class="card">

<div class="card-header">
    <div class="row">
        @php
        $postimages=explode(",",$values->post_image)
        @endphp

        @foreach($postimages as $images)
        <div class="col-4">
            @php
            $imageName = basename($images);
            @endphp
            <img src="{{asset('postimages/'.$images)}}" class="card-img-top shadow mt-2" height="50" alt="{{$images}}">

        </div>

        @endforeach
    </div>
</div>
<div class="card-body">

    <h5 class="card-text">{{$postByCategorView->post_cat_name}}</h5>
    <h5 class="card-text">{{$values->post_name}}</h5>
    <p class="card-text">{{$values->post_desc}}</p>


</div>
</div>
             </a>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>