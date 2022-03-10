    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | Create Ticket</title>
    </header>

    <body>
        <br>
        <div class="text-center">
            <h3>Create Ticket</h3>
            <p>To create a new ticket please fill out the form below</p>
        </div>
        <div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/tickets">
                        @csrf
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="A brief, pithy description of your request" required>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="departement">Departement</label>
                                <select class="form-control" id="departement" name="departement" required>
                                    @foreach($departements as $departement)
                                    <option value="{{$departement->key}}">{{$departement->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Please describe your request here" required></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    @endsection
