<?php
//recibimos los datos del formulario
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    //incluimos el archivo donde esta la clase
    include('../clases/usuario.php');
    //creamos el usuario
    $clase = new Usuario();
    //mandamos a llamar a la funión 
    $resultado = $clase->login($correo, $contraseña);//le enviamos lass variables

    $datos = mysqli_fetch_assoc($resultado);

    if(mysqli_num_rows($resultado) > 0){
       session_start();
       $_SESSION['idusuario']= $datos['id'];
       $_SESSION['usuario'] = $datos['usuario'];
       $_SESSION['correo'] = $datos['correo'];
       $_SESSION['tipo'] = $datos['tipo'];
       if($_SESSION['tipo'] == 0){
         header('location:../pantallas/indexadmin.php');
       }else{
         header('location:../pantallas/indexadmin.php');
       }
   
    }else{
        echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location.href = '../pantallas/login.php';
        </script>";
    }
?>