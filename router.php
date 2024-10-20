<?php 

require_once 'app/controllers/videogames.controller.php';
require_once 'app/controllers/plataforma.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new videogamesController();
        $controller->showHome();
        break;
    case 'videogames':
        $controller = new videogamesController();
        $controller->showAllVideogames();
        break;
    case 'view_detail_game':
        $controller = new videogamesController();
        $id = $params[1];
        $controller->showDetailVideogame($id);
        break;
    case 'manage-videogames':
        $controller = new videogamesController();
        if (!isset($params[1])) {
            $controller->showPageManageVideogames();
        } else if(isset($params[2])) {
            $id = $params[2];
            $controller->showPageEditVideogame($id);
        }
        break;
    case 'add_videogames':
        $controller = new videogamesController();
        $controller->addVideogames();
        break;
    case 'delete_videogame':
        $controller = new videogamesController();
        $id = $params[1];
        $controller->removeVideogame($id);
        break;
    case 'edit_videogame':
        $controller = new videogamesController();
        $id = $params[1];
        $controller->editVideogame($id);
        break;
    case 'plataforma' :
        $controller = new PlataformaController();
        $controller->showAllPlatforms();
        break;
    case 'view_detail_plats':
        $controller = new PlataformaController();
        $controller->showIdPlatforms($params[1]);
        break;
    case 'add_plataforma':
        $controller = new PlataformaController();
        $controller->addPlatform();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        echo("404 Page not found");
        break;
}