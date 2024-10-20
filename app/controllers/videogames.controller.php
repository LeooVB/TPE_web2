<?php

include_once 'app/models/videogames.model.php';
include_once 'app/views/videogames.view.php';
include_once 'app/models/platforms.model.php';

class videogamesController {

    private $model;
    private $view;

    public function __construct(){
        $this->model = new videogamesModel();
        $this->view = new videogamesView();

        $this->platforms = new platformsModel();
    }

    public function showHome(){
        $this->view->showHome();
    }

    public function showAllVideogames() {
        $videogamesWithPlatforms = $this->model->getAllVideogamesWithPlatforms();
        $this->view->showAllVideogames($videogamesWithPlatforms);
    }

    public function showDetailVideogame($id) {
        $videogame = $this->model->getVideogameById($id);
        $this->view->showDetailVideogame($videogame);
    }

    public function showPageManageVideogames() {
        $platforms = $this->platforms->getPlatforms();
        $videogamesWithPlatforms = $this->model->getAllVideogamesWithPlatforms();

        $this->view->showPageManageVideogames($videogamesWithPlatforms, $platforms);
    }

    public function addVideogames() {
        if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['desarrollador']) && !empty($_POST['desarrollador'])&& isset($_POST['distribuidor']) && !empty($_POST['distribuidor'])&&isset($_POST['genero']) && !empty($_POST['genero']) && isset($_POST['id_plataforma']) && !empty($_POST['id_plataforma']) && isset($_POST['fecha_lanzamiento']) && !empty($_POST['fecha_lanzamiento']) && isset($_POST['modos_de_juego']) && !empty($_POST['modos_de_juego']) && isset($_POST['precio']) && !empty($_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $desarrollador = $_POST['desarrollador'];
            $distribuidor = $_POST['distribuidor'];
            $genero = $_POST['genero'];
            $id_plataforma = $_POST['id_plataforma'];
            $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
            $modos_de_juego = $_POST['modos_de_juego'];
            $precio = $_POST['precio'];
    
            $id = $this->model->insertVideogames($nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio);

            if ($id != 0) {
                header("Location: " . BASE_URL . "manage-videogames");
            } else {
                $this->view->showError('Faltan datos obligatorios para añadir un nuevo item!');
                die();
            }
        } else {
            $this->view->showError('Error!');
        }
       
    }

    public function removeVideogame($id) {
        $this->model->deleteVideogame($id);

        header("Location: " . BASE_URL . "manage-videogames");
    }

    public function showPageEditVideogame($id) {
        $platforms = $this->platforms->getPlataforms();
        $videogame = $this->model->getVideogameById($id);

        $this->view->showPageEditVideogame($videogame, $platforms);

    }

    public function editVideogame($id) {
        if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['desarrollador']) && !empty($_POST['desarrollador'])&& isset($_POST['distribuidor']) && !empty($_POST['distribuidor'])&&isset($_POST['genero']) && !empty($_POST['genero']) && isset($_POST['id_plataforma']) && !empty($_POST['id_plataforma']) && isset($_POST['fecha_lanzamiento']) && !empty($_POST['fecha_lanzamiento']) && isset($_POST['modos_de_juego']) && !empty($_POST['modos_de_juego']) && isset($_POST['precio']) && !empty($_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $desarrollador = $_POST['desarrollador'];
            $distribuidor = $_POST['distribuidor'];
            $genero = $_POST['genero'];
            $id_plataforma = $_POST['id_plataforma'];
            $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
            $modos_de_juego = $_POST['modos_de_juego'];
            $precio = $_POST['precio'];

            print_r($_POST);

            $this->model->updateVideogame($nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio, $id);

            header("Location: " . BASE_URL . "manage-videogames");
        } else {
            $this->view->showError('Error!');
            die();
        }   
    }
   
}