<?php

    require_once 'config_bd.php';
    session_start();

    if(isset($_POST['llave'])){

        // si se quiere cargar de nuevo la tabla
        if($_POST['llave'] == "cargarTabla"){

            // obtener todas las pizzas para el usuario
            $id_usuario = $_SESSION['id_usuario'];
            $query = mysqli_query($conn, "SELECT * FROM PIZZA WHERE id_clientes = '$id_usuario';");

            if($query->num_rows > 0){
                while($data = mysqli_fetch_assoc($query)){
                    $sub_array["id_pizza"] = $data['ID_PIZZA'];
                    $sub_array['fecha'] = $data['FECHA'];
                    $sub_array['descripcion'] = $data['DESCRIPCION'];
                    $sub_array['total'] = "¢".$data['PRECIO_FINAL'];
                    $arreglo['data'][] = $sub_array;
                }
                echo json_encode($arreglo);
            }
            else{
                $arreglo['data'] = array();
                echo json_encode($arreglo);
                return;
            }
        }

        if($_POST['llave'] == "ordenarPizza"){
            $precioFinal = 0;
            $carne = $_POST['carne'];
            $vegetal = $_POST['vegetal'];
            $tamanho = $_POST['tamanho'];
            $masa = $_POST['masa'];
            
            // obtener tipo de carne
            $query = mysqli_query($conn, "SELECT * FROM TIPO_CARNES;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['TIPO_CARNE'] == $carne){
                    $id_carne = $fila['ID_TIPOCARNE'];
                    $precioFinal+= $fila['PRECIO'];
                    break;
                }
            }

            // obtener tipo de vegetal
            $query = mysqli_query($conn, "SELECT * FROM TIPOS_VEGETALES;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['TIPO_VEGETALES'] == $vegetal){
                    $id_vegetal = $fila['ID_TIPOVEGETALES'];
                    $precioFinal+= $fila['PRECIO'];
                    break;
                }
            }

            // obtener tipo de masa
            $query = mysqli_query($conn, "SELECT * FROM TIPO_MASAS;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['TIPO_MASA'] == $masa){
                    $id_masa = $fila['ID_TIPO_MASA'];
                    $precioFinal+= $fila['PRECIO'];
                    break;
                }
            }

            // obtener tamaño de pizza
            $query = mysqli_query($conn, "SELECT * FROM TAMANHO_PIZZA;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['TAMANHO'] == $tamanho){
                    $id_tamanho = $fila['ID_TAMANHO'];
                    $precioFinal+= $fila['PRECIO'];
                    break;
                }
            }

            $id_usuario = $_SESSION['id_usuario'];
            $descripcion = "<b>Pizza:</b> ".$tamanho."<br/><b>Tipo de pasta: </b>".$masa."<br/><b>Ingredientes:</b> ".$vegetal." y ".$carne;

            // insertar los datos
            $query = mysqli_query($conn, "INSERT INTO PIZZA (ID_TIPOCARNE, ID_TIPOVEGETALES, ID_TIPO_MASA, ID_TAMANHO, PRECIO_FINAL, FECHA, DESCRIPCION, ID_CLIENTES) 
            VALUES ('$id_carne', '$id_vegetal', '$id_masa', '$id_tamanho', '$precioFinal', NOW(), '$descripcion', '$id_usuario');");

            echo "Guardado";
            
        }

    }

    $conn->close();

?>