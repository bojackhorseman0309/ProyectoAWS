<?php

    require_once 'config_bd.php';

    if(isset($_POST['llave'])){


        // si es guardar un cliente
        if($_POST['llave'] == "guardarCliente"){
            $nombre = $_POST['nombre'];
            $primerApellido = $_POST['primerApellido'];
            $segundoApellido = $_POST['segundoApellido'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $hashed_pwd = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT);

            // verificar si ese correo aun no exite
            $sql = mysqli_query($conn, "SELECT * FROM clientes WHERE direccion = '$email';");

            if (mysqli_num_rows($sql) > 0) {
                echo "El correo ingresado ya ha sido registrado.";
                return;
            }
            else{
                // insertar los datos
                $query = mysqli_query($conn, "INSERT INTO clientes (nombre, apellido, segundo_apellido, direccion, clave, telefono) VALUES ('$nombre', '$primerApellido', '$segundoApellido', '$email', '$hashed_pwd', '$telefono');");
                
                // traer nombre y id del cliente
                $query = mysqli_query($conn, "SELECT id_clientes, nombre FROM clientes WHERE direccion = '$email';");

                // iniciar sesion
                session_start();

                // crear un arreglo asociativo con los resultados
                $datos = mysqli_fetch_array($query);
                
                // salvarlos en la sesion
                $_SESSION['id_usuario'] = $datos['id_clientes'];
                $_SESSION['nombre'] = $datos['nombre'];

                echo "Guardado";
            }
        }


        // si es cambiar de contraseña
        if($_POST['llave'] == "cambioPwd"){
            session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $hashed_pwd = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT);

            if(!mysqli_query($conn, "UPDATE clientes SET clave = '$hashed_pwd' WHERE id_clientes = '$id_usuario';")){
                echo "Error!";
                return;
            }
            else{
                exit("Cambiado");
            }
        }


        // si es cambiar de correo
        if($_POST['llave'] == "cambioCorreo"){
            session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $email = $_POST['email'];

            if(!mysqli_query($conn, "UPDATE clientes SET direccion = '$email' WHERE id_clientes = '$id_usuario';")){
                echo "Error!";
                return;
            }
            else{
                exit("Cambiado");
            }
        }

        // si es cerrar sesion
        if($_POST['llave'] == "cerrarSesion"){
            // inicializar la sesion
            session_start();
            // eliminar los datos de sesion en servidor
            $_SESSION = array();
            // destruir la sesion y revisar por errores
            if(session_destroy()){
                echo "Cerrada";
                return;
            }
            else{
                echo "Ocurrió un error, por favor inténtelo de nuevo. En caso de reocurrir, contáctenos a soporte@hotml.com";
                return;
            }
        }

        // si es eliminar cliente
        if($_POST['llave'] == "eliminarCuenta"){
            // inicializar la sesion
            session_start();
            $id_usuario = $_SESSION['id_usuario'];

            // eliminar los datos de sesion en servidor
            $_SESSION = array();
            // destruir la sesion y revisar por errores
            if(session_destroy()){
                // eliminar todas las compras de este cliente            
                if(!mysqli_query($conn, "DELETE FROM pizza WHERE id_clientes = '$id_usuario';")){
                    echo "Error!";
                    return;
                }
                // eliminar al cliente
                if(!mysqli_query($conn, "DELETE FROM clientes WHERE id_clientes = '$id_usuario';")){
                    echo "Error!";
                    return;
                }
            }
            else{
                echo "Error!";
                return;
            }
        }

        // si es iniciar sesion
        if($_POST['llave'] == "iniciarSesion"){
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];

            // ver si ese correo existe en base de datos
            $query = mysqli_query($conn, "SELECT id_clientes, nombre, direccion, clave FROM clientes WHERE direccion = '$email';");

            if(mysqli_num_rows($query) > 0){
                // crear arreglo asociativo con los resultados
                $datos = mysqli_fetch_array($query);    

                // si existe el correo, verificar clave
                if(password_verify($pwd, $datos['clave'])){
                    // contraseña correcta, iniciar sesion
                    session_start();
                    // salvarlos en la sesion
                    $_SESSION['id_usuario'] = $datos['id_clientes'];
                    $_SESSION['nombre'] = $datos['nombre'];
                    
                    echo "Correcto";
                    return;
                }
                else{
                    // contraseña incorrecta
                    echo "Correo o contraseña inválidos.";
                    return;
                }
            }
            else{
                echo "Correo o contraseña inválidos.";
                return;
            }
        }
    }

    $conn->close();

?>