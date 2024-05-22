<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <title>Post</title>
</head>

<body>
    @extends('index')
    @section("content")
    <div class="container">

        @if(session('status'))
        <script>
            if (window.performance.navigation.type !== 2) {
                Swal.fire({
                    title: "Good job!",
                    text: "{{session('status')}}",

                    icon: "success"
                });
            }
        </script>
        @endif
        <h1>Add Post </h1>



        <div class="card p-5">
            <form action="{{route('postStore')}}" method="post" enctype="multipart/form-data">
                @csrf

                <select class="form-select" name="post_category_id" aria-label="Default select example">
                    <option selected value="">Open this select menu</option>
                    @if($show)
                    @foreach($show as $values)
                    <option value="{{$values->id}}">{{$values->post_cat_name}}</option>
                    @endforeach
                    @endif

                </select>
                <input type="text" name="post_name" class="form-control mt-3" placeholder="Post Title">
                @error('post_cat_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <textarea name="post_desc" class="form-control mt-3" placeholder="Post Description"></textarea>
                @error('post_desc')
                <p class="text-danger">{{$message}}</p>
                @enderror



                <!-- <b>desc</b>
                <input type="file" name="post_desc[]"  multiple class="form-control mt-3">
                @error('post_desc')
                <p class="text-danger">{{$message}}</p>
                @enderror -->


                <input type="file" name="post_image[]" id="inputImage" multiple class="form-control mt-3">
                @error('post_image')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <button type="submit" class="mt-3 btn bg-dark text-white">Add Post</button>

            </form>
            <img  src="" class="d-none mt-3" id="previewImage" height="60" width="100">
<h3 id="getPreviewImageName"></h3>
            
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
<script>
    let  inputImage=document.getElementById("inputImage");
    let  previewImage=document.getElementById("previewImage");
    let  getPreviewImageName=document.getElementById("getPreviewImageName");

    inputImage.addEventListener("change",function(e){
if(e.target.files.length===0){
    return;
}
else{
previewImage.classList.remove("d-none");
let file=e.target.files[0];
getPreviewImageName.textContent=file.name;
let tmpUrl=URL.createObjectURL(e.target.files[0]);
previewImage.setAttribute("src",tmpUrl);
}
});
</script>
    @endsection

</body>

</html>


