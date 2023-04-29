<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE PELÍCULAS</title>
<link href="web/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container">
<div id="header">
<h1>MI PELÍCULAS PREFERIDAS versión 1.0</h1>
</div>
<div id="minimenu">
    <form action="index.php">
        <input type="text" name="dato">
        <select name="filtro">
            <option value="nombre">Título</option>
            <option value="director">Director</option>
            <option value="genero">Género</option>
        </select>
        <input type='hidden' name='orden' value='Buscar'>
        <input type="submit" value="Filtrar">
    </form>
</div>
<div id="content">
<?= $contenido ?>
</div>
</div>
</body>
</html>
