<!-- @extends('layouts.app')

@section('content') -->
<style>
    body {
         background-color: purple; /* Fondo de color naranja */
         /*background-image: url('ruta/de/tu/imagen.jpg');  Ruta de la imagen de fondo */
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         margin: 0;
     }
 
     .card-container {
         position: relative;
     }
     
     .card {
         width: 100%;
         max-width: 400px; /* Ancho máximo de la tarjeta */
         text-align: center;
         background-color:rgba(245, 245, 245, 0.2);
         border-radius: 17px;
         padding: 25px; 
         margin-top: 55%; 
         position: relative;
         z-index: 2;
         backdrop-filter: blur(14px) 
     }
 
     .background-text {
         text-align: center;
         position: absolute;
         top: 30%;
         left: 50%;
         transform: translate(-50%, -50%);
         font-family: 'NexaBlack', sans-serif;
         color: white;
         font-size: 150px;        
         z-index: 1;
     }
 
     .btn-primary {
         background-color: transparent; /* Botón transparente */
         border: 1px solid white; /* Borde blanco para resaltar el botón transparente */
         color: white; /* Texto blanco */
         padding: 10px 20px; /* Espaciado interno del botón */
         border-radius: 10px;
         cursor: pointer;
         transition: backdrop-filter 0.3s ease; /* Transición suave para el efecto de desenfoque */
         backdrop-filter: blur(0); /* Inicialmente sin desenfoque */
     }
 
     .btn-primary:hover {
         backdrop-filter: blur(30px); /* Desenfoque al hacer hover */
     }
 </style>
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">{{ __('Reset Password') }}</div>
 
                 <div class="card-body">
                     <form method="POST" action="{{ route('password.update') }}">
                         @csrf
 
                         <input type="hidden" name="token" value="{{ $token }}">
 
                         <div class="row mb-3">
                             <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
 
                             <div class="col-md-6">
                                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
 
                                 @error('email')
                                     <span class="invalid-feedback" role="alert" >
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                         </div>
 
                         <div class="row mb-3">
                             <label for="password" class="col-md-4 col-form-label text-md-end" >{{ __('Password') }}</label>
 
                             <div class="col-md-6">
                                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
 
                                 @error('password')
                                     <span class="invalid-feedback" role="alert" >
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                         </div>
 
                         <div class="row mb-3">
                             <label for="password-confirm" class="col-md-4 col-form-label text-md-end" >{{ __('Confirm Password') }}</label>
 
                             <div class="col-md-6">
                                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                             </div>
                         </div>
 
                         <div class="row mb-0">
                             <div class="col-md-6 offset-md-4">
                                 <button type="submit" class="btn btn-primary" >
                                     {{ __('Cambiar') }}
                                 </button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
             <div class="background-text">Olvidé mi contraseña</div>
         </div>
     </div>
 </div>
 <!-- @endsection -->