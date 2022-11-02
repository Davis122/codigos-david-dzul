<?php

include_once 'conexion.php';


//llamar todos los articulos

$sql = 'SELECT * FROM articulos';
$sentencia = $pdo->prepare($sql);
$sentencia->execute();


$resultado = $sentencia->fetchALL();


//var_dump ($resultado);

$articulos_x_pagina = 3;

//contar articulos bd
$total_articulos_db = $sentencia->rowCount();
//echo $total_articulos_db;
$paginas = $total_articulos_db/3;
$paginas = ceil($paginas);
//echo $paginas;

?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  
  
  <div class="container my-5">

    <h1 class="mb-5">Paginación</h1>

    <?php 
    if(!$_GET){
        header('location:index.php?pagina=1');

    }
    if($_GET['pagina']>$paginas || $_GET['pagina']<= 0 ){
      header('location:index.php?pagina=1');
    }

    $iniciar = ($_GET['pagina']-1)*$articulos_x_pagina;
    //echo $iniciar;

    $sql_articulos = 'SELECT * FROM articulos LIMIT :iniciar,:narticulos';
    $sentencia_articulos = $pdo->prepare($sql_articulos);
    $sentencia_articulos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
    $sentencia_articulos->bindParam(':narticulos', $articulos_x_pagina, PDO::PARAM_INT);
    $sentencia_articulos->execute();


    $resultado_articulos = $sentencia_articulos->fetchALL();
    
    ?>



    <?php foreach($resultado_articulos as $articulo): ?>
    <div class="alert alert-primary" role="alert">
  <?php echo $articulo['titulo']?>
</div>
<?php endforeach ?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item
    <?php echo $_GET['pagina']<=1? 'disabled': '' ?>
    ">
       
    <a class="page-link"
     href="index.php?pagina= <?php echo $_GET['pagina']-1?>">
        Anterior
    </a>
    
    </li>
    
    <?php for($i=0;$i<$paginas;$i++): ?>
    <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
        <a class="page-link" href="index.php?pagina=<?php echo $i+1 ?>">
            <?php echo $i+1 ?>
        </a>
    </li>
    <?php endfor ?>
   
    
    <li class="page-item
    <?php echo $_GET['pagina']>=$paginas? 'disabled': '' ?>
    "><a class="page-link" 
    href="index.php?pagina= <?php echo $_GET['pagina']+1?>">Siguiente</a></li>
  </ul>
</nav>

  </div>

    
  </body>
</html>