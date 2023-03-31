<?php
    class Situacaos extends Controller{
        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->statusModel = $this->model('Situacao');
        }

        public function index() { 

            $this->view('situacaos/index', $data=0);            
           
        }        
}   
?>