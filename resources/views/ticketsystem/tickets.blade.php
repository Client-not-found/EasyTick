@extends('layout.app')

@section('content')
<header>
    <title>Ticketsystem | Dashboard</title>
</header>
<body>
    <br>
    <div class="text-center">
        <h3>Ticket list</h3>
        <p>Here you can see your ticket history.</p>
    </div>
    <div class="col-md-12">
        @can('create', App\Ticket::class)
        <button type="button" class="btn btn-success" @click="newTicket">Create new ticket</button>
        @endcan
        <br>
        <br>
        <table class="table">
            <thead class="bg-secondary text-white">
                <tr>
                    <th scope="col" class="col-md-2">ID</th>
                    <th scope="col" class="col-md-5">Departement</th>
                    <th scope="col" class="col-md-5">Subject</th>
                </tr>
            </thead>
        </table>
        @foreach($tickets as $ticket)
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
    </div>
</body>
@endsection
