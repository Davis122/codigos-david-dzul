<?php

include_once 'conexion.php';

$sql_leer ='SELECT * FROM colores';
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchALL();

//var_dump($resultado);


//agregar
if($_POST){
  $color = $_POST['color'];
  $descripcion = $_POST['descripcion'];

  $sql_agregar = 'INSERT INTO colores (color,descripcion) VALUES (?,?)';
  $sentencia_agregar = $pdo->prepare($sql_agregar);
  $sentencia_agregar->execute(array($color,$descripcion));


  $sentencia_agregar = null;
  $pdo = null;

  header('location:index.php');
}

if($_GET){
    $id = $_GET['id'];
    $sql_unico ='SELECT * FROM colores WHERE id=?';
    $gsent_unico = $pdo->prepare($sql_unico);
    $gsent_unico->execute(array($id));
    $resultado_unico = $gsent_unico->fetch();

    //var_dump($resultado_unico);
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1e21fe3de7.js" crossorigin="anonymous"></script>
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
      <div class="col-md-6">

    

            <?php foreach($resultado as $dato): ?>

            <div 
            class="alert alert-<?php echo $dato['color']?> text-uppercase" 
            role="alert">
                <?php echo $dato['color']?> 
                
                <?php echo $dato['descripcion']?>

                <a href="eliminar.php?id=<?php echo $dato['id']?>"
                 class="float-right ml-3">
                  <i class="fa-solid fa-trash"></i></a>

                <a href="index.php?id=<?php echo $dato['id']?>"
                 class="float-right">
                <i class="fa-sharp fa-solid fa-pencil"></i>
              </a>
            </div>

 
 
            <?php endforeach ?>

</div>

<div class="col-md-6">
  <?php  if(!$_GET): ?>
<h2>AGREGAR ELEMENTOS</h2>   
<form method="POST">
      <input type="text" class="form-control" name="color">
      <input type="text" class="form-control mt-3" name="descripcion">
      <button class="btn btn-primary mt-3">Agregar</button>
    </form>
    <?php endif ?>

    <?php  if($_GET): ?>
<h2>EDITAR ELEMENTOS</h2>   
<form method="GET" action="editar.php">
      <input type="text" class="form-control" name="color"
      value="<?php echo $resultado_unico['color'] ?>">
      <input type="text" class="form-control mt-3" name="descripcion"
      value="<?php echo $resultado_unico['descripcion'] ?>">
      <input type="hidden" name="id" 
      value="<?php echo $resultado_unico['id'] ?>">
      <button class="btn btn-primary mt-3">Agregar</button>
    </form>
    <?php endif ?>
</div>

</div>
    
</div>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

<?php
$pdo = null;
$gsent = null;


?>