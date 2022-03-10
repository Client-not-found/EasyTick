    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | Security</title>
    </header>
    <body>
        <br>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/profile/{{auth()->user()->key}}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/security">Security</a>
            </li>
        </ul>
        <br>
        <div class="text-center">
            <h4>Security Settings</h4>
            <p>Here you can make changes to your security settings.</p>
        </div>
        <br>
        <div class="card card-shadow col-md-6 offset-md-3">
            <div class="card-body">
                @if(! auth()->user()->two_factor_secret)
                <div class="alert alert-danger" role="alert">
                    <p>You have not enabled 2FA</p>
                </div>
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="btn btn-primary" disabled>Disabled in the demo</button>
                </form>
                @else
                <div class="alert alert-success" role="alert">
                    <p>You have enabled 2FA</p>
                </div>
                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Disable</button>
                </form>
                @endif

                @if(session( 'status' ) == 'two-factor-authentication-enabled')
                <div class="alert alert-success" role="alert">
                    <p>You have now enabled 2FA, please scan the following QR code into your phones authenticator application.</p>
                </div>
                {{!! auth()->user()->twoFactorQrCodeSvg() !!}}

                <p>Please store these recovery codes in a secure location.</p>
                @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                {{ trim($code) }} <br>
                @endforeach
                @endif
            </div>
        </div>
        @endsection
