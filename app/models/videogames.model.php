<?php

class videogamesModel {

    private $db;

    public function __construct(){
        $this->db = $this->getConnection();
    }

    public function getConnection () {
        return new PDO('mysql:host=localhost;'.'dbname=tienda_videojuegos;charset=utf8', 'root', '');
    }


    public function getVideogames() {
        $queryVideogames = $this->db->prepare('SELECT * FROM videojuegos');
        $queryVideogames->execute();

        $videogames = $queryVideogames->fetchAll(PDO::FETCH_OBJ);

        return $videogames;
    }


    public function getAllVideogamesWithPlatforms() {

        $queryVideogames = $this->db->prepare('SELECT videojuegos.*, plataformas.plataforma FROM videojuegos JOIN plataformas ON videojuegos.id_plataforma = plataformas.id_plataforma ORDER BY videojuegos.id_juego ASC');
        $queryVideogames->execute();
        $videogamesWithPlatforms = $queryVideogames->fetchAll(PDO::FETCH_OBJ); 

        
       return $videogamesWithPlatforms;
    }


    public function getVideogameById($id) {
        $queryVideogames = $this->db->prepare('SELECT videojuegos.*, plataformas.plataforma FROM videojuegos JOIN plataformas ON videojuegos.id_plataforma = plataformas.id_plataforma WHERE id_juego = ?');
        $queryVideogames->execute([$id]);

        $videogame = $queryVideogames->fetchAll(PDO::FETCH_OBJ);

        return $videogame;
    }




    public function insertVideogames($nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio) {
        $queryVideogames = $this->db->prepare('INSERT INTO videojuegos (nombre, desarrollador, distribuidor, genero, fecha_lanzamiento, id_plataforma, modos_de_juego, precio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $queryVideogames->execute([$nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio]);

        return $this->db->lastInsertId();
    }

    public function deleteVideogame($id) {
        $queryVideogames = $this->db->prepare('DELETE FROM videojuegos WHERE id_juego = ?');
        $queryVideogames->execute([$id]);
    }

    public function updateVideogame($nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio, $id) {

        $queryVideogames = $this->db->prepare('UPDATE videojuegos SET nombre = ?,desarrollador = ?,distribuidor = ?,genero = ?,fecha_lanzamiento = ?,id_plataforma = ?,modos_de_juego = ?,precio = ? WHERE id_juego = ?');
        $queryVideogames->execute([$nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio, $id]);
    }
} 