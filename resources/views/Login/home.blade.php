@extends('layout')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title> 
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body>
    <div class="row">
        <div class="cold-md-6">

            <form method="POST" action="{{ route('login_action') }}">
                @csrf
                
                <div class="loginDiv" id="loginDiv">
                	<h1>Login</h1>
                	<div class="inputField">
                		<input type="text" id="username" name="username" required aria-invalid="false" value="{{ old('username') }}" />
                		<label>Username</label>
                	</div>
                	<div class="inputField">
                		<input type="password" id="password" name="password" required aria-invalid="false"/>
                		<label>Password</label>
                	</div>

                    <div class="login">
                        <button>
                            Login
                        </button>
                    </div>
                	
                </div>

            </form>
        </div>
    </div>
</body>
</html>
    
    
@endsection