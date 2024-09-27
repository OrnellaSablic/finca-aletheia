<?php
require('./controlador/controlador.php');
require('./controlador/controlador-admin.php');

error_reporting(E_ALL);
    ini_set('display_errors', 0);

$productos = mostrar_productos();

$email = $_SESSION['email'];
  if (!isset($email)){
    header('Location:index.php');
}
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel de administración</title>
    <!-- Favicon-->
    <link rel="icon" type="im/x-icon" href="img/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container px-4 px-lg-5">
            <div>
                <a href="">
                    <img class="logo" src="img/logo-aletheia.png" alt="" width="70px">
                </a>
            </div>
            <div class="titulo-panel">
              <h4>Panel de administración (Finca Aletheia)</h4>
            </div>
            <div class="">
            <button type="button" class="btn btn-primary"><a class="btn-link" href="/finca-aletheia/www/index.php">Volver al sitio</a></button>
          </div>
        </div>
    </nav>
    <?php 
           if (!in_array($extension_archivo, $extensiones)) {
                  echo $mensaje1;
               }else {
                  if (isset($_POST['btnAgregar'])) {
                      echo $mensaje2;
                    }else{
                      echo $mensaje3;
                    }
                }
          ?>
    <?php
         if (isset($_POST['btnEliminar'])) {
              echo $mensajeEliminar;
           }
        ?>

    <div class="mt-5 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><img src="img/add.png" alt="">Añadir producto</button>
    </div>
    <!-- Modal agregar producto-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Añadir producto</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </button>
          </div>
          <div class="modal-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- nombre-->
                <div class="form-group">
                  <label for="" class="text-dark">Nombre del producto</label>
                  <input type="text" name="nombre_producto" id="nombre" class="form-control" value="" placeholder="nombre del producto" required>
                  <br>
                  <!-- descripción-->
                  <label for="" class="text-dark">Descripción</label>
                  <textarea class="form-control" name="descripcion" rows="3" placeholder="descripción del producto" required></textarea>
                  <br>
                  <!-- imagen-->
                  <div class="form-group">
                    <label for="exampleFormControlFile1">Seleccioná una imagen</label>
                    <br>
                    <input type="file" name ="imagen" class="form-control-file" id="exampleFormControlFile1" required>
                  </div>
                </div>
                  <br>
                 <!-- precio y stock-->
                <div class="row">
                  <div class="col">
                    <label for="" class="text-dark">Precio</label>
                    <input type="number" name="precio" class="form-control" value="" required>
                  </div>
                  <div class="col">
                    <label for="" class="text-dark">Stock</label>
                    <input type="number" name="stock"  class="form-control" value="" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" name="btnAgregar" value="enviar" id="btn-registro" class="btn btn-primary">Añadir producto</button>
                </div>
              </form>
            </div>
        </div>
      </div>
</div>
    <div class="mt-5">
    <!--Table-->
        <table class="container table w-auto table-responsive-sm table-striped">
          <!--Table head-->
          <thead>
            <tr class="">
              <th class="">Codigo</th>
              <th class="">Imagen</th>
              <th class="">Producto</th>
              <th class="w-25">Descripción</th>
              <th class="">Precio</th>
              <th class="">Stock</th>
              <th>Modificar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <!--Table head-->
          <!--Table body-->
          <tbody class="align-center">
          <?php foreach ($productos as $producto) { ?>
              <tr class="">
                <th class="text-center" scope="row"><?php echo $producto['id']; ?></th>
                <td><img src="img/<?php echo $producto['imagen']; ?>" width="100px" /></td>
                <td><?php echo $producto['nombre_producto']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td>$<?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
                
                <td><a href="editar.php?id=<?php echo $producto['id']; ?>" class="btn btn-success btn-Editar" value="Editar"><img src="img/write.png" alt="icono de papel y lapiz que representa la modificacion de un elemento"></td>
              <td>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                    <button type="submit" name="btnEliminar" value="" id="btn-registro" class="btn btn-danger"><img src="img/delete.png" alt="icono de cesto de basura que representa la eliminacion de un elemento"></button>
                </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          <!--Table body-->
        </table>
    </div>

</script>

</body>
</html>