<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post view</title>
    <style>
        .post_desc {
            /*   
  position: relative !important;
  
            /* text-overflow: ellipsis; */
            
            overflow: hidden;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            display: -webkit-box;
            text-overflow: ellipsis !important;

        }
    </style>
</head>

<body>
    @extends("index")
    @section('content')
    <div class="container ">
<div class="card">
    <div class="card-header">here</div>
    @foreach($postCategory as $values)
<div class="card-body">
    <a href="/post-by-category/{{$values->id}}" target="_blank">{{$values->post_cat_name}}</a>
</div>
    @endforeach
</div>
        <div class="row">
            @foreach($show as $values)
            <div class="col-md-4 col-6">
            <div class="card shadow-sm mt-3">

                <div class="card-header">
                    <div class="row">
                        @php
                        $postImages = explode(',', $values->post_image);
                        @endphp
                        @foreach($postImages as $image)
                        <div class="col-4">
                            <!-- <img src="{{ asset('postimages/' . $image) }}"   class="card-img-top shadow pt-1" height="50"  alt="..."> -->   
                            <img src="{{ asset('storage/' . $image) }}" class="card-img-top shadow pt-1" height="50" alt="...">
                        </div>
                        @endforeach
                    </div>
                </div>



                    <div class="card-body">

                        <p class="card-title">Posted {{$values->created_at->diffForHumans()}}</p>
                        <!-- <p class="card-title">Posted {{$values->created_at->format('F j, Y, g:i a')}}</p> -->
                        <h5 class="card-title">{{$values->post_name}}</h5>
                        <h5 class="card-title">{{$values->categoryHas->post_cat_name}}</h5>
                        <p class="card-text post_desc">{{$values->post_desc}}</p>
                        <a href="{{url('/slug/mlug/'.$values->post_name .'/'.$values->id)}}" class="btn btn-primary">See More</a>
                        <a href="{{route('postUpdate',$values->id)}}" class="btn btn-warning">Update</a>
                        <a href="{{route('postDelete',$values->id)}}" class="btn btn-danger">postDelete</a>
                    </div>


                </div>
                </div>


                @endforeach
                @if(method_exists($show,'links'))
   {{$show->links()}}
@endif
            </div>

        </div>
    @endsection

</body>

</html>