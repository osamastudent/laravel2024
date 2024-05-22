<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
    <title>home</title>
</head>
<body>

    @extends("index")
    @section('content')
    <div class="card w-75 mx-auto mt-5 p-3">
        <a href="{{route('sendEmail')}}">emailSend</a>
<x-testComponent pass="this is pasword using passin variable " >
<h2>i,am sending  from  where i called this compnent as a slot</h2>
<x-slot  name="name">this is named sloting</x-slot>
<x-slot name="email">this is email using named slot</x-slot>

</x-testComponent>


            <h1 class=" text-center card-title">all users</h1>
            <a href="/trashrecords">trashrecords</a>
            <a href="/">home</a>
            <a href="/registerForm">register</a>
            <a href="/login">login</a>
            <a href="/logout">logout</a>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Actions</th>
                            <th>
                            <input type="checkbox" id="checkAll"> <label for="checkAll">Restore All</label>    
                             &nbsp; <a href="{{route('deleteAllUsers')}}">Delete All</a>
                        
                        </th>
                        </tr>
                    </thead>
                    <tbody>
<form action="selectidsfortrash" method="post">
    @csrf;
    
                        @if($show)
                        @foreach($show as $values)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$values->name}}</td>
                            <td>{{$values->email}}</td>
                            <!-- <td><img src="{{asset('storage/userImages/'.$values->image)}}" height="50" alt=""></td> -->
                            <td>
                            @if(in_array($values->mime_type,['image/png', 'image/jpg','image/jpeg']))
                            <img src="{{asset('storage/userImages/'.$values->image)}}" height="50" alt="">

                            @elseif(in_array($values->mime_type,['application/octet-stream','application/pdf', 'text/html', 'text/plain']))
                            <iframe src="{{asset('storage/userImages/'.$values->image)}}" frameborder="0" height="50"></iframe>
                            
                            @else
                            @endif
                            </td>
                            <!-- <td><img src="{{asset('userImages/'.$values->image)}}" height="50" alt=""></td> -->

                            
                            <td>
                                <!-- <a href="{{route('deleteUsers',$values->id)}}" onclick="return confirm('Are you sure you want to delete?')">Delete</a> -->
                                <a href="{{route('deleteUsers',$values->id)}}" >trash</a>
                            
                                &nbsp; <input type="checkbox" name="ids[]" value="{{$values->id}}" id="selectid{{$loop->index}}"> <label for="selectid{{$loop->index}}">trash</label>
                                

                                &nbsp; <a href="/update/{{$values->id}}">Update</a>
                                &nbsp; <a href="/download/{{$values->id}}">download</a>
                            
                            </td>

                        </tr>
                        @endforeach
                        @endif
    <td colspan="2"><button type="submit" class="btn btn-primary" >Restore Selected</button>
<a href="/trashall" class="btn btn-success">Trash All</a></td>

</form>
                 </tbody>
                </table>
            </div>

        </div>
    </div>
    @endsection('content')

</body>

</html>
<script>
  const checkAll = document.getElementById('checkAll');
const checkboxes = document.querySelectorAll('input[type="checkbox"][name="ids[]"]');

checkAll.addEventListener('change', () => {
    checkboxes.forEach((checkbox) => {
        checkbox.checked = checkAll.checked;
    });
});
</script>
   