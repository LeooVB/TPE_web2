<?php

class PlatformsView{


    function ShowPlatforms($plataformas){
         
        require_once 'templates/plataforma.phtml';
             
    
    }
    function showIdPlatforms($plataformas){

        require_once 'templates/view_detail_plats.phtml';
    }


}