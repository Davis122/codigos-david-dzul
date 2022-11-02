<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=paginacion_v2', 'root', '');
    //echo 'conectado';

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}