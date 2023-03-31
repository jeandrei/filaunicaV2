<!-- Apenas para poder redirecionar para a administração do sistema com o endereço filaunica/adm -->

<?php
    class Adm extends Controller{
        public function __construct(){
            // 1 Chama o model         
        }

        public function index(){ 
          
          if((!isLoggedIn())){                
            $this->view('users/login');            
          } else if($_SESSION[DB_NAME . '_user_type'] != "admin"){
            $this->view('users/login');
          } else {
            $this->view('pages/sistem');
          }
             
        }       
        

      

}