
@include('sweetalert::alert')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/stylesregister.css') }}">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Registro</h3>
				<div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-github"></i></span>
					<span><i class="fab fa-instagram"></i></span>
				</div>
			</div>
			<div class="card-body">
			<form method="POST" action="{{ route('register.verify') }}" enctype="multipart/form-data">
			@csrf
                        @error('invalid_credentials')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <small>
                                    {{$message}}
                                </small>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="name" placeholder="Escriba su Nombre">
                        @error('name')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="apellidos" placeholder="Escriba sus Apellidos">
                        @error('apellidos')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="date" class="form-control" name="nacimiento" placeholder="Escriba su fecha de Nacimiento">
                        @error('nacimiento')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="dni" placeholder="Escriba su DNI">
                        @error('name')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>                
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control" name="email" placeholder="Escriba el Email">
                        @error('email')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-image"></i></span>
						</div>
						<input class="form-control" type="file" name="foto" id="foto">
                        @error('foto')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="password" placeholder="Contraseña">
                        @error('password')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="password_confirmation" placeholder="Confirme la Contraseña">
                        @error('password_confirmation')
                            <small class="text-danger mt-1">
                                <strong>{{$message}}</strong>
                            </small>
                        @enderror
					</div>
					<div class="form-group">
                        <a href="{{route('users')}}">
                        <input type="btn" value="Volver" class="btn float-left login-btn" style="width: 150px;">
                        </a>
						<input type="submit" value="Registrar" class="btn float-right login_btn">
					</div>
				</form>
			</div>
            <div class="mt-3 text-center">
                <a href="{{ route('register') }}"></a> <a href="{{ route('login') }}"></a>
            </div>
			<div class="card-footer">
				<div class="d-flex justify-content-center">
					<a href="#"></a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>