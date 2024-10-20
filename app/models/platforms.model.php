<?php

class platformsModel {
    private $db;

    public function __construct(){
        $this->db = $this->getConnection();
    }

    public function getConnection () {
        return new PDO('mysql:host=localhost;'.'dbname=tienda_videojuegos;charset=utf8', 'root', '');
    }

    public function getPlatforms() {
        $query = $this->db->prepare('SELECT * FROM plataformas');
        $query->execute();
        $platforms = $query->fetchAll(PDO::FETCH_OBJ);
        return $platforms;
    }
    public function getPlatformById($id) {
        $query = $this->db->prepare('SELECT * FROM videojuegos WHERE id_plataforma = ?');
        $query->execute([$id]);
        $platforms = $query->fetchAll(PDO::FETCH_OBJ);
        return $platforms;

    }
    public function addPlatform($plataforma, $fabricante, $tipo) {
        $query = $this->db->prepare('INSERT INTO plataformas(plataforma, fabricante, tipo) VALUES (?,?,?)');
        $query->execute([$plataforma, $fabricante, $tipo]);
        return $this->db->lastInsertId();
    }

}