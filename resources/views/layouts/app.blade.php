<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ResitApp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/app.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @yield('styles')
</head>

<body class="d-flex flex-column min-vh-100" x-data="{ flash: true }">
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="/">ResitApp</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth('web')
              <li class="nav-item">
                  <a href="{{ route('student.courses') }}" class="nav-link text-light">Dashboard</a>
              </li>
              <li class="nav-item dropdown" x-data="{ showNotification: {{ $announcements->count() > 0 ? 'true' : 'false' }} }">
                <a 
                    class="nav-link dropdown-toggle text-light" 
                    href="#" 
                    id="announcementDropdown" 
                    role="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    @click="showNotification = false"> <!-- Hide the badge when dropdown is clicked --> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                    </svg>
                    
                    <!-- Notification Badge (Flash message) -->
                    <span 
                        class="badge bg-danger" 
                        style="position: absolute; top: -5px; right: -5px;" 
                        x-show="showNotification && {{ $announcements->count() }} > 0" 
                        x-text="{{ $announcements->count() }}"
                    ></span>
                </a>
            
                <ul class="dropdown-menu" aria-labelledby="announcementDropdown">
                    @foreach($announcements as $announcement)
                        <li>
                            <a class="dropdown-item" href="{{ route('student.course.announcements', ['course' => $announcement->course_id]) }}">
                                {{ $announcement->title }} <small class="text-muted">({{ $announcement->course->course_code }})</small>
                            </a>
                        </li>
                    @endforeach
            
                    @if($announcements->isEmpty())
                        <li><a class="dropdown-item" href="">No recent announcements</a></li>
                    @endif
                </ul>
            </li>
            
          
              
          @endauth
      
          @auth('instructor')
              <li class="nav-item">
                  <a href="{{ route('instructor.courses') }}" class="nav-link text-light">Dashboard</a>
              </li>
          @endauth
      
          @auth('secretary')
              <li class="nav-item">
                  <a href="{{ route('secretary.courses') }}" class="nav-link text-light">Dashboard</a>
              </li>
          @endauth
      </ul>


         <ul class="navbar-nav mb-2 mb-lg-0"> 
          @auth('web')
          <li class="nav-item">
            <a href="" class="nav-link text-light">{{ auth('web')->user()->name }}</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('student.logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-dark">Logout</button>
            </form>
          </li>
          @endauth

          @auth('instructor')
          <li class="nav-item">
            <a href="" class="nav-link text-light">{{ auth('instructor')->user()->name }}</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('instructor.logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-dark">Logout</button>
            </form>
          </li>

          @endauth

          @auth('secretary')
          <li class="nav-item">
            <a href="" class="nav-link text-light">{{ auth('secretary')->user()->name }}</a>
          </li>
          <li class="nav-item"></li>
            <form action="{{ route('secretary.logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-dark">Logout</button>
            </form>
          </li>
          @endauth

          @guest
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link text-light"> Login</a>
          </li>
          @endguest
        
        </ul>
      </div>
    </div>
  </nav>

  @if (session()->has('success'))
  <div x-show="flash" x-transition class="alert alert-success alert-dismissible fade show" role="alert">
    <strong class="font-bold">Success!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="flash = false"></button>
  </div>
  @endif

  @if (session()->has('error'))
  <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong class="font-bold">Error!</strong> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
  </div>
  @endif 

   @if ($errors->any())
  <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="alert alert-danger alert-dismissible fade show" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
  </div>
  @endif

  <main class="container mt-4">
    @yield('content')
  </main>

  <footer class="container-fluid bg-dark text-light text-center py-3 mt-auto">
    &copy; {{ date('Y') }} Resit App
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
