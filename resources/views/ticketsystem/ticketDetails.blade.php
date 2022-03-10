    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | Ticket Details</title>
    </header>

    <body>
        <br>
            <div class="row">
                @foreach($messages as $message)
                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">{{$message->user->firstname}} {{$message->user->lastname}}</h5>
                        <div class="card-body">
                            <p class="card-text">{{$message->message}}</p>
                        </div>
                    </div>
                    <br>
                </div>
                @endforeach
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Status</h6>
                            <p class="card-text">{{$ticket->status}}</p>
                            <h6 class="card-subtitle mb-2">Departement</h6>
                            <p class="card-text">{{$ticket->departement->name}}</p>
                            <h6 class="card-subtitle mb-2">Subject</h6>
                            <p class="card-text">{{$ticket->subject}}</p>
                            <hr>
                            <p class="card-subtitle mb-2"> Manage Ticket </p>
                            @if ($ticket->status === 'Open')
                            <form method="post" action="/newstatus/{{$ticket->key}}">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="status" name="status" value="Close">
                                </div>
                                <button type="submit" class="btn btn-warning" @click="newStatus">Close Ticket</button>
                            </form>
                            @else
                            <form method="post" action="/newstatus/{{$ticket->key}}">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="status" name="status" value="Open">
                                </div>
                                <button type="submit" class="btn btn-success" @click="newStatus">Open Ticket</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @if ($ticket->status === 'Open')
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/newmessage/{{$ticket->key}}">
                                @csrf
                                <div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Add a new Message"></textarea>
                                </div>
                                <div class="form-group">
                                </div>
                                <br>
                                <button type="submit" @click="newMessage" class="btn btn-outline-success">Submit</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info" role="alert">
                        <p>The ticket is closed, you can no longer reply to it. If you want to add a reply open the ticket again.</p>
                    </div>
                    @endif
                    <br>
                    <br>
                    <br>
                </div>
            </div>
    </body>
    @endsection
