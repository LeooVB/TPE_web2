<?php

include_once 'app/models/platforms.model.php';
include_once 'app/views/plataformas.view.php';


class PlataformaController{
    private $Plataforma_model;
    private $Plataforma_view;


    public function __construct() {
        $this->Plataforma_model = new platformsModel();
        $this->Plataforma_view = new PlatformsView();
    
    }
    
    public function showAllPlatforms(){
        $plataformas = $this->Plataforma_model->getPlatforms();
        $this->Plataforma_view->ShowPlatforms($plataformas);
            
    }
    public function showIdPlatforms($id){
        $plataformas = $this->Plataforma_model->getPlatformById($id);
        $this->Plataforma_view->showIdPlatforms($plataformas);
            
    }
    public function addPlatform()
{
    $plataformas = $_POST ['plataforma'];
    $fabricante = $_POST ['fabricante'];
    $tipo = $_POST ['tipo'];
    if (empty($_POST['plataforma'])) {
        echo 'error';
        die();
    }
    $plataformas = $_POST['plataforma'];
    $this->Plataforma_model->addPlatform($plataformas, $fabricante, $tipo);
    header('Location: ' . BASE_URL);
}
}

