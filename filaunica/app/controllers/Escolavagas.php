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
                    if($escola_vaga = $this->escolaVagasModel->getEscolaVagas($_POST['escola_id'])){
                        foreach ($escola_vaga as $row){
                            $data['etapas'][] = [
                                'id' => $row->id,
                                'descricao' => $row->descricao,
                                'qtd' => $row->qtd
                            ];     
                        }
                    } else {
                        $data['etapas'] = $this->etapaModel->getEtapas();
                    }   
                    //die(var_dump($data['etapas']));
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

        public function vagas($escola_id){            
           
            if((!isLoggedIn()) && (!isAdmin() || !isUser() || !isSec())){ 
                flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
                redirect('users/login');
                die();
            } 


            if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data['post'] = [
                    'escola_id' => $escola_id,                 
                    'escola_id_err' => ''                   
                ]; 
                

                /*Vai verificar para cada post se foi passado a quantidade e se é numérico*/
                foreach($_POST as $key => $valor){ 
                    if((empty($valor) && $valor<>'0') || $valor==="" || $valor==='NULL'){
                        $data['post']['escola_id_err'] = "Etapas sem informação!";
                    } else if(!is_int(intval($valor)) || (intval($valor)==='NULL' && $valor <> '0')){
                            $data['post']['escola_id_err'] = "Etapas com valor inválido!";
                    } else {
                        $data['escolavaga'][$key] = $valor;
                    }
                }                

                if(                    
                    empty($data['post']['escola_id_err'])
                ){
                    try {
                        foreach($data['escolavaga'] as $key => $qtd){
                             if(!$this->escolaVagasModel->register($escola_id,$key,$qtd)){
                                throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                            }  
                        }
                            flash('message', 'Cadastro realizado com sucesso!','success');
                            $escola_vaga = $this->escolaVagasModel->getEscolaVagas($escola_id); 
                            
                            foreach ($escola_vaga as $row){
                                $data['etapas'][] = [
                                    'id' => $row->id,
                                    'descricao' => $row->descricao,
                                    'qtd' => $row->qtd
                                ];     
                            }

                            $this->view('escolavagas/vagas', $data);

                    } catch (Exception $e) {
                        $erro = 'Erro: '.  $e->getMessage(). "\n";
                        flash('message', $erro,'error');
                        $this->view('escolasvagas/vagas',$data);
                    }                      
                } else {   
                    $data['etapas'] = $this->etapaModel->getEtapas();                 
                    $this->view('escolavagas/vagas',$data);
                }

            } else {                
                if($escola_vaga = $this->escolaVagasModel->getEscolaVagas($escola_id)){
                    foreach ($escola_vaga as $row){
                        $data['etapas'][] = [
                            'id' => $row->id,
                            'descricao' => $row->descricao,
                            'qtd' => $row->qtd 
                        ];     
                    }
                } else {
                    $data['etapas'] = $this->etapaModel->getEtapas(); 
                }               
                $this->view('escolavagas/vagas',$data);
            }  //IF POST
            
          




            
         
        }

              
}   
?>