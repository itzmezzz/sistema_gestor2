<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="icon" type="image/png" href="../imagenes/gera.png">
     <link rel="stylesheet" href="../css/style_login.css">
     
</head>
<body>
    <h2>Iniciar sesión</h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="../controladores/insertar_usuario.php"  method="POST">
			<h1>Crear cuenta</h1>
			
			<span>nombre de usuario</span>
			<input type="text" placeholder="Name" name="usuario" requiered/>
			<input type="email" placeholder="Email" name="correo" required/>
			<input type="password" placeholder="Password" name="contraseña" required/>
			<button value="guardar">registrarse</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="../controladores/iniciar_sesion.php" method="POST">
			<h1>INICIAR SESIÓN</h1>
			<span>Utiliza tu Email nombre de usuario</span>
			<input type="email"  placeholder="Email" name="correo" required/>
			<input type="password" placeholder="Password" name="contraseña" required/>
			
			<a href="#">Contraseña olvidada?</a>
			<button>iniciar sesion</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>!Bienvenido!</h1>
				<p>Si tienes cuenta Inicia sesion</p>
				<button class="ghost" id="signIn">Iniciar sesion</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Bienvenido de nuevo</h1>
				<p>Si no tienes cuenta registrate !Aqui!</p>
				
				<button class="ghost" id="signUp">registrarse</button>
				
			</div>
		</div>
	</div>
</div>

<script src="../js/script.js"></script>
</body>
</html>