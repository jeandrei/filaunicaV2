<?php
    class Escolavagas extends Controller{
        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->escolaModel = $this->model('Escola');
            $this->escolaVagasModel = $this->model('Escolavaga');
            $this->usuarioEscolaModel = $this->model('Usuarioescola');
            $this->etapaModel = $this->model('Etapa');;
        }

        public function index() { 
            
            //pego o id do usuário
            $user_id = $_SESSION[DB_NAME . '_user_id'];

            if((!isLoggedIn()) && (!isAdmin() || !isUser() || !isSec())){ 
                flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
                redirect('users/login');
                die();
            } 

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //init data
                $data['post'] = [
                    'escola_id' => ($_POST['escola_id']),                 
                    'escola_id_err' => ''                   
                ]; 
                
                // Valida escola_id
                if(empty($data['post']['escola_id']) || $data['post']['escola_id'] == 'NULL'){
                    $data['post']['escola_id_err'] = 'Por favor informe a escola';
                } 

                if(                    
                    empty($data['post']['escola_id_err'])
                ){
                    $data['etapas'] = $this->etapaModel->getEtapas();
                    $this->view('escolavagas/vagas', $data);
                } else {                    
                    if($data['escolas'] = $this->usuarioEscolaModel->getEscolasDoUsuario($user_id)){
                        $this->view('escolavagas/index', $data);
                    }
                }


            } else {
                if($data['escolas'] = $this->usuarioEscolaModel->getEscolasDoUsuario($user_id)){
                    $this->view('escolavagas/index', $data);
                } else {                                 
                    $this->view('usuarioescolas/index');
                }  
            }

                        
             
        }

        public function vagas(){

            if((!isLoggedIn()) && (!isAdmin() || !isUser() || !isSec())){ 
                flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
                redirect('users/login');
                die();
            } 


            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data['post'] = [
                    'escola_id' => $_POST['escola_id'],                 
                    'escola_id_err' => ''                   
                ]; 

                /*Vai verificar para cada post se foi passado a quantidade e se é numérico*/
                foreach($_POST as $key => $valor){  
                    if(empty($valor) || $valor=="" || $valor=='NULL'){
                        $data['post']['escola_id_err'] = "Etapas sem informação!";
                    } else if(!is_int(intval($valor)) || intval($valor)=='NULL'){
                            $data['post']['escola_id_err'] = "Etapas com valor inválido!";
                    } else {
                        $data['post'][$key] = $valor;
                    }
                }                

                if(                    
                    empty($data['post']['escola_id_err'])
                ){
                    //fazer o gravar aqui
                    var_dump($data['post']);
                } else {   
                    $data['etapas'] = $this->etapaModel->getEtapas();                 
                    $this->view('escolavagas/vagas',$data);
                }

            }//IF POST




            
         
        }

              
}   
?>