<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>index</title>
</head>

<body>
    <div class="container">

        <h1>Add Post Category</h1>
        @if(session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{(session('status'))}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card p-5">
            <form action="{{route('postCategoryStore')}}" method="post" class="">
                @csrf
                <input type="text" name="post_cat_name" class="form-control mt-3" placeholder="Category Name">
                @error('post_cat_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <button type="submit" class="mt-3 btn bg-dark text-white">Add Category</button>


            </form>
        </div>
    </div>
</body>

</html>