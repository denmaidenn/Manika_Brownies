@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ url('css/app.css') }}">
    <div class="container">
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

    
    
@endsection