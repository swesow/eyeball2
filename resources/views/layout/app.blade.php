<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Eyeball</title>
</head>
<body>
<!-- nav -->
<div class="container">
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="{{ route('clients.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    <span class="fs-4">Eyeball</span>
    </a>

    <ul class="nav nav-pills">
    <li class="nav-item"><a href="#" class="nav-link disabled"><i class="bi bi-person-circle"></i> {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</a></li>
    <li class="nav-item"><a href="{{ route('clients.index') }}" class="nav-link @isset($active_page) @if($active_page == 'client') active @endif @endisset" aria-current="page">Clients</a></li>
    @if (auth()->user()->user_type == 'admin')
    <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link @isset($active_page) @if($active_page == 'user') active @endif @endisset">Users</a></li>
    @endif
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-link">Logout</button>
        </form>
        
    </li>
    </ul>
</header>
</div>
<!-- END nav -->

@yield('content')

<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')
    
</body>
</html>