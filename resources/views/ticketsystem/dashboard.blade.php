    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | Dashboard</title>
    </header>

    <body>
        <div class="text-center">
            <br>
            <h3>Dashboard</h3>
            <p>Welcome {{auth()->user()->firstname}} {{auth()->user()->lastname}}</p>
        </div>
        <br>
        <!-- Statistik -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-white card-green">
                        <h5 class="card-title">Tickets Open</h5>
                        <h6 class="card-subtitle mb-2 text-white">{{$countOpenTickets}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-white card-red">
                        <h5 class="card-title">Tickets Closed</h5>
                        <h6 class="card-subtitle mb-2 text-white">{{$countClosedTickets}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-white card-blue">
                        <h5 class="card-title">Tickets Total</h5>
                        <h6 class="card-subtitle mb-2 text-white">{{$countTickets}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Offene Tickets -->
        <h4>Open tickets </h4>
        <table class="table">
            <thead class="bg-secondary text-white">
                <tr>
                    <th scope="col" class="col-md-2">ID</th>
                    <th scope="col" class="col-md-5">Departement</th>
                    <th scope="col" class="col-md-5">Subject</th>
                </tr>
            </thead>
        </table>
        @foreach($openTickets as $ticket)
        <div class="list-group-item list-group-item-action" aria-current="true">
            <a href="/ticket/{{$ticket->key}}">
                <div class="row">
                    <b class="col-md-2">{{$ticket->key}}</b>
                    <p class="col-md-5">{{$ticket->departement->name}}</p>
                    <p class="col-md-5">{{$ticket->subject}}</p>
                </div>
            </a>
        </div>
        @endforeach

    </body>
    @endsection
