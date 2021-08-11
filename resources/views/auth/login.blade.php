<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zenys Immo - Connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ url('/assets/img/zenys_logo.png' )}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/vendor/daterangepicker/daterangepicker.css')}}">
    <!--=======================================================================================
    ========-->
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/assets/connexion/css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body class="bg-info" >


	<div class="limiter">
       <div class="container-login100" >

       		<div class="wrap-login100">

             <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="{{ route('login') }}">
                    @csrf

                    <span class="login100-form-title" id="login">Connexion </span>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" id="mail" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus> @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
									</span> @enderror
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Please enter password">
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Mot de passe" required autocomplete="current-password"> @error('password')
                        <span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span> @enderror
                        <span class="focus-input100"></span>


                    </div> <br>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
							Se connecter
						</button>
                    </div>  <br>


                </form>
            </div>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="{{url('/assets/connexion/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('/assets/connexion/vendor/animsition/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('/assets/connexion/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{url('/assets/connexion/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('/assets/connexion/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('/assets/connexion/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{url('/assets/connexion/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('/assets/connexion/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('/assets/connexion/js/main.js')}}"></script>

</body>

</html>
