<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('/')}}">Главная</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/articles">Articles</a>
        </li>
        @can('create')
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/articles/create">Create article</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/comment/index">All comments</a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link" href="{{url('/about')}}">О нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/contacts')}}">Контакты</a>
        </li>
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Notifications {{auth()->user() -> unreadNotifications -> count()}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach(auth()->user()->unreadNotifications as $notification)
            <li><a class="dropdown-item" href="{{route('articles.show', ['article'=>$notification->data['article']['id'], 'notify'=>$notification->id])}}">{{$notification->data['article']['name']}}</a></li>
            @endforeach
          </ul>
        </li>
        @endauth
      </ul>
        @guest
          <a href="/auth/signup" class="btn btn-outline-success mr-3 me-3" style="margin-right: 3px;">Sign up</a>
          <a class="btn btn-outline-success me-3" type="submit" href="/auth/login">Sign in</a>
        @endguest
        @auth
          <a class="btn btn-outline-success me-3" type="submit" href="/auth/logout">Logout</a>
        @endauth
    </div>
  </div>
</nav>
    </header>
    <main>
      <div class="container">
        <div id=app>
          
        </div>
        @yield('content')
      </div>
    </main>
    <footer>
        <p> Реунин Сергей Эдуардович 231-323 </p>
    </footer>
</body>
</html>