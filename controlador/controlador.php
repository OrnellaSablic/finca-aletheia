<?php

session_start();

require('./modelo/modelo.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

//MOSTAR PRODUCTOS
	function mostrar_productos(){
		$conexion = mysqli_connect('localhost', 'root', '', 'finca_aletheia');
		$query = "SELECT * FROM productos";
		$resultado = $conexion->query($query);
		$productos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

		if ($resultado === false) {
			die("Error en la consulta SQL: " . mysqli_error($conexion));
		}else{
			mysqli_close($conexion);
		return $productos;
		}
		
	}

	
//REGISTRAR USUARIO

	//Filtrado común para los datos
		function filtrarDatos($datos){
			$datos = trim($datos); // Elimina espacios antes y después de los datos
			$datos = stripcslashes($datos); // Elimina backslashes \
			$datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
			return $datos;
		}

	//La función 'filtrarDatos()' se aplica a cada campo del formulario al recibir los datos:

	if (isset($_POST['btnReg'])) {
		$mensaje = "";
		$nombre = filtrarDatos($_POST['nombre']);
		$apellido = filtrarDatos($_POST['apellido']);
		$email = filtrarDatos($_POST['email']);
		$password = filtrarDatos($_POST['password']);
		$password = password_hash($password, PASSWORD_BCRYPT);
  
		

	//validacion del formulario de registro
	
		// $error_nombre = $error_apellido = $error_email = $error_password = '';

		// if(empty($_POST['nombre'])){
        // 	echo $error_nombre = "El nombre es requerido";
    	// }
    	// if(empty($_POST['apellido'])){
        // 	echo $error_apellido = "El apellido es requerido";
    	// }
	    
	    // if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['email'])){
	    //     echo $error_email = "El formato de email es incorrecto";
	    // }
	    // if(empty($_POST["password"])){
	    //     echo $error_password = "La contraseña es requerida";
	    // }
		// if(strlen($_POST['password']) < 4){
		// 	echo "La contraseña contener más de 4 caracteres";
		// }
	  //Chequeo que el email ingresado al registrarse no exista en la BD


		$check_email = mysqli_num_rows(mysqli_query($conexion, "SELECT email FROM usuarios WHERE email = '$email'"));
		
			if ($check_email > 0) {
				 	 $mensaje ='<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
					 <strong>El email que ingresaste ya existe</strong>
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					   <span aria-hidden=""></span>
					 </button>
				   </div>';
			}else {
				 $query = "INSERT INTO usuarios (nombre, apellido, email, password) VALUES ('$nombre', '$apellido', '$email', '$password')";
				 $resultado = mysqli_query($conexion, $query);
				 if ($resultado) {
					 	 $mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
						 <strong>Ya estás registrado/a. Ahora podés iniciar sesión.</strong>
						 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
						   <span aria-hidden=""></span>
						 </button>
					   </div>';
				 	}else {
					 	$mensaje = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
						 <strong>Ocurrió un error, intentá de nuevo</strong>
						 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
						   <span aria-hidden=""></span>
						 </button>
					   </div>';
		}
	}
	mysqli_close($conexion);
}

//LOGIN USUARIO

if (isset($_POST['btnLogin'])) {
	// Datos formulario
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	  

	  $query = 'SELECT count(*) exist, email, password FROM usuarios WHERE email = ?';
	  $stmt = $conexion->prepare($query);
	  
	  $stmt->bind_param("s",$email);

	  $stmt->execute();

	  $stmt->bind_result($exist,$email,$passwordHash);
	  $stmt->fetch();
	  $stmt->close();
	  // Existe resultado
	  if ($exist > 0) {    
		// Verificar contraseña
		if (password_verify($password,$passwordHash)) {
		  // Creas sesion
		  $_SESSION['email'] =  $email;
		  $_SESSION['password'] =  $passwordHash;
			
		   $mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
					 <strong>¡Bienvenido/a a nuestra Finca!</strong>
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					   <span aria-hidden=""></span>
					 </button>
				   </div>';
		}else {
		   $mensaje = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
					 La contraseña ingresada es incorrecta
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					   <span aria-hidden=""></span>
					 </button>
				   </div>';             
		}
	  }  else {
		 $mensaje = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
						El email ingresado no pertenece a un usuario registrado
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  				<span aria-hidden=""></span>
					</button>
	  				</div>';
	  } 
	 	 mysqli_close($conexion);
	}  
	
  
	// CARRITO DE COMPRAS

	if (isset($_POST['btnComprar'])) {
		$mensaje = "";
		$id = $_POST['id'];
		$producto = $_POST['nombre_producto'];
		$imagen = $_POST['imagen'];
		$precio = $_POST['precio'];
		$cantidad = $_POST['cantidad'];
		
	
		if (!isset($_SESSION['carrito'])) {
			$producto = array(
				'id' => $id,
				'nombre_producto' => $producto,
				'imagen' => $imagen,
				'precio' => $precio,
				'cantidad' => $cantidad
			);
			
			$_SESSION['carrito'][0] = $producto;//almacena el primer producto en la posicion 0
			 $mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
					El producto se añadió al carrito
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"></span>
					</button></div>';
			
			}else{ //pero si tenemos un producto en el carrito
				$numeroProductos = count($_SESSION['carrito']);//contabiliza el carrito de compras
				//recupera los datos del producto ya seleccionado
  
				$producto = array(
					'id' => $id,
					'nombre_producto' => $producto,
					'imagen' => $imagen,
					'precio' => $precio,
					'cantidad' => $cantidad
				);
				//numero de elementos que obtuvimos al contabilizar la variable de session
				$_SESSION['carrito'][$numeroProductos] = $producto;
				
				$mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
					El producto se agregó al carrito
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"></span>
					</button></div>';
			}
		}	

		//eliminar producto del carrito
		if (isset($_POST['btnEliminar'])) {
			foreach($_SESSION['carrito'] as $indice => $producto){
				if ($producto['id'] == $_POST['id']) {
					unset($_SESSION['carrito'][$indice]);
					$mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
					El producto se eliminó del carrito
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"></span>
					</button></div>';
				}
			}
		}
?>

