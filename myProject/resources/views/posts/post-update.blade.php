<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>post update</title>
</head>

<body>
    <div class="container">

        <h1>post update </h1>
        @if(session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{(session('status'))}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card p-5">
            <form action="{{url('post-update',$findId->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <select class="form-select" name="post_category_id" aria-label="Default select example">
                    <option selected value="">Open this select menu</option>
                    @if($show)
                    @foreach($show as $values)

                    <option value="{{$values->id}}" {{old('post_category_id',$findId->post_category_id)==$values->id ? 'selected' : ''}}>{{$values->post_cat_name}}
                    </option>

                    @endforeach
                    @endif

                </select>

                <input type="text" name="post_name" value="{{$findId->post_name}}" class="form-control mt-3" placeholder="Post Title">
                @error('post_cat_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <textarea name="post_desc" class="form-control mt-3" placeholder="Post Description">{{$findId->post_desc}}</textarea>
                @error('post_desc')
                <p class="text-danger">{{$message}}</p>
                @enderror



                <!-- <b>desc</b>
                <input type="file" name="post_desc[]"  multiple class="form-control mt-3">
                @error('post_desc')
                <p class="text-danger">{{$message}}</p>
                @enderror -->


                <input type="file" name="post_image[]" multiple class="form-control mt-3">
                @error('post_image')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="card-footer">
                    <div class="row">
                        @php
                        $postimages=explode(',',$findId->post_image)
                        @endphp
                        @foreach($postimages as $values)
                        <div class="col-3">
                            <img src="{{asset('postimages/'.$values)}}" class="shadow-sm" width="100%" height="100" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="mt-3 btn bg-dark text-white">Update Post</button>


            </form>
        </div>
    </div>
</body>

</html>