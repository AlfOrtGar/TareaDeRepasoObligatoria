<?php
include_once 'app/Pelicula.php';
// Ruta del propio script 
$ruta = $_SERVER['PHP_SELF'];
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();

?>

<table>
<th>Código</th><th>Nombre</th><th>Director</th><th>Genero</th>
<?php foreach ($peliculas as $peli) : ?>
<tr>		
<td style="text-align:center"><?= $peli->codigo_pelicula ?></td>
<td><?= $peli->nombre ?></td>
<td style="text-align:center"><?= $peli->director ?></td>
<td style="text-align:center"><?= $peli->genero ?></td>
<td><a href="<?= $ruta?>?orden=Borrar&codigo=<?=$peli->codigo_pelicula?>" onclick="confirmarBorrar('<?= $peli->nombre."','".$peli->codigo_pelicula."'"?>);">Borrar</a></td>
<td><a href="<?= $ruta?>?orden=Modificar&codigo=<?=$peli->codigo_pelicula?>">Modificar</a></td>
<td><a href="<?= $ruta?>?orden=Detalles&codigo=<?= $peli->codigo_pelicula?>">Detalles</a></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<form name='f2' action='index.php'>
<input type='hidden' name='orden' value='Alta'> 
<input type='submit' value='Nueva Película' >
</form>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido de la página principal
$contenido = ob_get_clean();
include_once "principal.php";

?>