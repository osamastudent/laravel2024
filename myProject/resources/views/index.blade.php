<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- bootstrap5 cdn -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="mycss/index.css">
    <title>index</title>
</head>
<body>
<div class="alert alert-primary mb-0 p-0" role="alert">
  A simple primary alert—check it out!
</div>
<nav class="navbar mt-0 navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page"  href="/home" id="dashboard">dashboard</a>
        </li>
            
        <li class="nav-item">
          <a class="nav-link " href="/login">login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/registerForm">register</a>
        </li>
        
        <!-- <a class="nav-link {{Request::is('home') ? 'active' : ''}}" aria-current="page"  href="/home">dashboard</a>
          {{Request::is('blogs') ? 'active' : ''}}
          {{Request::is('sendNotification') ? 'active' : ''}}
          {{Request::is('post') ? 'active' : ''}}
          {{Request::is('post-view') ? 'active' : '' }} -->
        <li class="nav-item">
          <a class="nav-link " href="/sendNotification">Send Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('postCategory')}}" id="postCategory">Post Category</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="{{route('post')}}" id="post">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('postView')}}" id="postView">Post View</a>
        </li>
        
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div> 
</nav>

@yield("content")




<div class="alert alert-primary p-0 mt-4 border-0 rounded-0 text-center" role="alert">
  <h1>this is footer</h1>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>
<script>
var dashboard=document.getElementById("dashboard");
var post=document.getElementById("post");
var postView=document.getElementById("postView");
var postCategory=document.getElementById("postCategory");

window.addEventListener("load",function(){
currentPath=location.pathname;
if(currentPath==="/home"){
dashboard.classList.add("active");
}
else if(currentPath==="/post"){
  post.classList.add("active");
}
});

</script>