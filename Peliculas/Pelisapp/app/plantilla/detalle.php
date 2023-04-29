<?php
ob_start();
?>
<h2> Detalles </h2>
<table>
<tr><td>Código</td><td><?= $peli->codigo_pelicula ?></td></tr>
<tr><td>Nombre</td><td><?= $peli->nombre ?></td></tr>
<tr><td>Director</td><td><?= $peli->director ?></td></tr>
<tr><td>Genero</td><td><?= $peli->genero  ?></td></tr>
<tr><td>Portada</td><td><img src="app/img/<?= $peli->imagen ?>" width="100%" height="100%" alt="Cartelera"/></td></tr>
</table>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido

$contenido = ob_get_clean();
include_once "principal.php";

?>