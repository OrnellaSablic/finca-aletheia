<?php
    require('./modelo/modelo.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 0);


 //AGREGAR PRODUCTO   

        if (isset($_POST['btnAgregar'])) {
            $mensaje = "";
            $nombre = $_POST['nombre_producto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $imagen = $_FILES['imagen']['name'];
        
            $extensiones = array('png', 'jpg', 'jpeg');
            $nombre_archivo = $_FILES['imagen']['name'];
            $extension_archivo  = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

                    if (!in_array($extension_archivo,$extensiones)) {
                        $mensaje1 = '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                        El archivo subido debe ser jpg, jpeg o png y su tamaño no debe exeder los 2 MB
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                     }else{

                    $query = "INSERT INTO productos (nombre_producto, descripcion, precio, stock, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$imagen')";
                    $resultado = mysqli_query($conexion, $query);

                if($resultado) {

                    move_uploaded_file($_FILES['imagen']['tmp_name'], "img/".$_FILES['imagen']['name']);

                       $mensaje2 = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                       <strong>El producto se cargó en la base de datos.</strong>
                       <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden=""></span>
                       </button>
                       </div>';
                 }else{
            
                    $mensaje3 = '<div class="alert alert-alert alert-dismissible fade show" role="alert">
                            Ocurrió un error, intentalo de nuevo
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
            }
        }
         mysqli_close($conexion);
    }


//-------------------------------------------------------------------

//MODIFICAR PRODUCTO
 
if(isset($_POST['btnModificar'])) {
    
    $id = $_POST['id'];
    $nombre = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $img_nueva = $_FILES['imagen']['name'];
    $img_anterior = $_POST['img-anterior'];

    if ($img_nueva === '') {
            $update_file = $img_anterior;
        } else {
            $update_file = $_FILES['imagen']['name'];
        }
            
            if ($_FILES['imagen']['name'] != '') {
                move_uploaded_file($_FILES['imagen']['tmp_name'], "img/".$_FILES['imagen']['name']);
                
                //echo 'imagen actualizada';
            } else {
                //echo 'la imagen no pudo actualizarse';
            }

    $query = "UPDATE productos SET nombre_producto = '$nombre', descripcion = '$descripcion', precio = '$precio', stock = '$stock', imagen = '$update_file' WHERE id = '$id'";
    
        $resultado = mysqli_query($conexion, $query);
            if ($resultado) {
            //      $aviso1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            //     Los datos del producto se editaron exitosamente
            //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //         <span aria-hidden="true">&times;</span>
            //     </button>
            // </div>';
             echo '<script>alert("Los datos del producto se modificarion exitosamente")</script>';
            } else {
            //      $aviso2 = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            //     Los datos no pudieron actualizarse, intentá de nuevo
            //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //         <span aria-hidden="true">&times;</span>
            //     </button>
            // </div>';
            echo '<script>alert("Los datos no pudieron actualizarse, intentá de nuevo")</script>';
         } 
            mysqli_close($conexion);
       }

//-------------------------------------------------------------------

  //ELIMINAR PRODUCTO

       if (isset($_POST['btnEliminar'])) {
            $id = $_POST['id'];
  
            $query = "DELETE FROM productos WHERE id = $id";
            $resultado = mysqli_query($conexion,$query);
        
            $mensajeEliminar ='<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>El producto se eliminó de la base de datos.</strong>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden=""></span>
                    </button>
                    </div>';
            mysqli_close($conexion);    
          }
