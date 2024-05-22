<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>post view</title>
<style>
    .card-text{
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


        <div class="card" style="width: 18rem;">
           <div class="card-header">
            <div class="row">
            @php
            $images=explode(',',$findSlugId->post_image)
            @endphp

            @foreach($images as $values)
            <div class="col">
            <img src="{{asset('postimages/'.$values)}}" class="card-img-top shadow" alt="...">
            </div>
            @endforeach
            </div>
           </div>

            {{-- <h5>{{$findSlugId->post_name}}</h5> --}}

            <div class="card-body">
            <p class="card-title">posted: {{$findSlugId->created_at->diffForhumans()}}</p>

            <p class="card-text">{{$findSlugId->post_desc}}</p>
                <h5 class="card-title">{{$findSlugId->post_name}}</h5>
                <h5 class="card-title">categor: {{$findSlugId->post_cat_name}}</h5>

            </div>
        </div>

    </div>
</body>

</html>