<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar text-white">
        <a class="navbar-brand" href="/home">EasyTick</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/home">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tickets">Tickets</a>
                </li>
                @if($knowledgebase->status == 1)
                <li class="nav-item">
                    <a class="nav-link" href="/knowledgebase">Knowledge Base</a>
                </li>
                @endif
                @can('view', App\User::class)
                <li class="nav-item">
                    <a class="nav-link" href="/acp">ACP</a>
                </li>
                @endcan
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 navbar-last">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->firstname}} {{auth()->user()->lastname}}</a>
                    <ul class="dropdown-menu" ria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/profile/{{auth()->user()->key}}">Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" id="app">@yield('content') </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

<footer class="footer col-md-12">
    <nav class=" navbar-dark text-white">
        <p class="text-center">(c)-2021 Client-not-found | EasyTick</p>
    </nav>
</footer>

</html>
