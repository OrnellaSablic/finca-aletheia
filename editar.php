<?php
require('./controlador/controlador.php');
require('./controlador/controlador-admin.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$productos = mostrar_productos();

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
        </div>
    </nav>
      
    <div class="container mt-5">
     <div class="row justify-content-center">
        <div class="col-sm-8 col-md-6 col-lg-6">

            <?php
                    $id = $_GET['id'];
                    $query = "SELECT * FROM productos WHERE id = '$id'";
                    $resultado = mysqli_query($conexion, $query);

                    if (mysqli_num_rows($resultado) > 0) {
                        foreach ($resultado as $row) { 
            ?>

          <div class="card">
           <div class="modal-body">
            <div class="modal-header"><strong>Modificar datos del producto:</strong></div>
            <form class="p-3" method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']?>">
                <div class="form-group">
                    <label for="" class="text-dark">Nombre del producto</label>
                    <input type="text" name="nombre_producto" id="nombre" class="form-control" value="<?php echo $row['nombre_producto']; ?>" required>
                  <br>
                  <!-- descripción-->
                    <label for="" class="text-dark">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="3"><?php echo $row['descripcion']; ?></textarea>

                  <br>
                  <!-- imagen-->
                <div class="form-group">
                    <label for="exampleFormControlFile1">Seleccioná una imagen</label>
                    <br>
                    <input type="file" name ="imagen" id="imagen" value= "" class="form-control-file" id="exampleFormControlFile1"><img src="img/<?php echo $row['imagen']; ?>" width=200px>
                    <input type="hidden" name ="img-anterior" value="<?php echo $row['imagen']?>">
                </div>
                </div>
                  <br>
                 <!-- precio y stock-->
                <div class="row">
                  <div class="col">
                    <label for="" class="text-dark">Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control" value="<?php echo $row['precio']; ?>">
                  </div>
                  <div class="col">
                    <label for="" class="text-dark">Stock</label>
                    <input type="number" name="stock"  id="stock" class="form-control" value="<?php echo $row['stock']; ?>">
                  </div>
                  <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>">
                </div>
                <!-- footer-form-->
                <div class="modal-footer">
                  <a href="admin-finca.php" class="btn btn-secondary">Cancelar</a>
                  <button type="" name="btnModificar" value="enviar" id="btn-registro" class="btn btn-primary">Guardar cambios</button>
                </div>
                </form>
            </div>
        </div>

    <?php
        }
           
          }else {
             echo  '<div class="text-center">
                      <button type="button" class="btn btn-primary btn-link btn-panel"><a href="/finca-aletheia/www/admin-finca.php">Volver al Panel</a></button>
                    </div>';
        }              
    ?>
    </div>
  </div>
</body>
</html>