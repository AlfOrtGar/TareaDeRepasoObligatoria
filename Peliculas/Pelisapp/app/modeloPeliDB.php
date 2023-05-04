<?php

include_once 'config.php';
include_once 'Pelicula.php';

class modeloPeliDB {

     private static $dbh = null; 
     private static $consulta_peli = "Select * from peliculas where codigo_pelicula = ?";
     private static $modifica_peli = "Update peliculas set nombre = ?, director = ?, genero = ? where codigo_pelicula = ?";
     private static $borra_peli = "Delete from peliculas where codigo_pelicula = ?";
     private static $nueva_peli = "Insert into peliculas (codigo_pelicula,nombre,director,genero) Values (?,?,?,?)";
     
public static function init(){
   
    if (self::$dbh == null){
        try {
            // Cambiar  los valores de las constantes en config.php
            $dsn = "mysql:host=".DBSERVER.";dbname=".DBNAME.";charset=utf8";
            self::$dbh = new PDO($dsn,DBUSER,DBPASSWORD);
            // Si se produce un error se genera una excepción;
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        
    }
    
}

public static function UltimoID (){
    $stmt=self::$dbh->query("Select MAX(codigo_pelicula) from peliculas");
    $id=$stmt->fetchColumn();
    return $id;
}

// Tabla de objetos con todas las peliculas
public static function GetAll ():array{
    // Genero los datos para la vista que no muestra la contraseña
    
    $stmt = self::$dbh->query("select * from peliculas");
    
    $tpelis = [];

    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
}


public static function Buscar ($filtro,$dato){
    //Los % son para que detecte cadenas, principios y finales, incluso articulos
    //Y las comillas para que MySQL lo detecte como un parametro
    $dato="'%".$dato."%'";

    $stmt=self::$dbh->query("Select * from peliculas where $filtro like $dato");

    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    $stmt->execute();
    $tpelis = [];
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
}

public static function getOne ($codigo){
    $stmt = self::$dbh->prepare(self::$consulta_peli);
    $stmt->bindValue(1,$codigo);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    $stmt->execute();
    $peli = $stmt->fetch();
    return $peli;
}

public static function Borrar ($codigo){
    $stmt = self::$dbh->prepare(self::$borra_peli);
    $stmt->bindValue(1,$codigo);
    $stmt->execute();
}

public static function Nuevo($titulo,$director,$genero){
    $id=ModeloPeliDB::UltimoID();
    $id++;
    $stmt = self::$dbh->prepare(self::$nueva_peli);
    $stmt->bindValue(1,$id);
    $stmt->bindValue(2,$titulo);
    $stmt->bindValue(3,$director);
    $stmt->bindValue(4,$genero);
    $stmt->execute();
}

public static function Actualizar($id,$titulo,$director,$genero){
    $stmt = self::$dbh->prepare(self::$modifica_peli);
    $stmt->bindValue(1,$titulo);
    $stmt->bindValue(2,$director);
    $stmt->bindValue(3,$genero);
    $stmt->bindValue(4,$id);
    $stmt->execute();
}


public static function closeDB(){
    self::$dbh = null;
}

} // class
