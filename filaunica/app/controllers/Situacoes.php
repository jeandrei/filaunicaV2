<?php
    class Situacoes extends Controller{
        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->situacaoModel = $this->model('Situacao');
        }

        public function index() {

            if((!isLoggedIn())){ 
                redirect('index');
            }  
           
            $situacoes = $this->situacaoModel->getSituacoes();

            foreach($situacoes as $row){
                $data[] = array(
                  'situacaoId' => $row->id,
                  'situacao' => $row->descricao, 
                  'ativo' => $row->ativonafila == 1 ? 'SIM' : 'NÃO',
                  'cor' => $row->cor
                );       
            } 

            $this->view('situacoes/index', $data);
        }
        
        

        public function new(){  
            
            if((!isLoggedIn())){ 
                redirect('users/login');
            }  
           
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){             
                // Process form
                
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);    


                //init data
                $data = [
                    'situacao' => trim($_POST['situacao']),
                    'ativo' => trim($_POST['ativo']),
                    'cor' => trim($_POST['cor']),                    
                    'situacao_err' => '',
                    'ativo_err' => '',
                    'cor_err' => ''
                ];                

                

                // Valida Situação
                if(empty($data['situacao'])){
                    $data['situacao_err'] = 'Por favor informe a Situação';
                } 

                // Valida se é ativo ou não na fila               
                if((($data['ativo'])=="") || ($data['ativo'] <> '0') && ($data['ativo'] <> '1')){
                    $data['ativo_err'] = 'Por favor informe se fica ativo na fila';
                } 

                // Valida cor
                if(empty($data['cor'])){
                    $data['cor_err'] = 'Por favor informe uma cor';
                } 
                              
                
                // Make sure errors are empty
                if(                    
                    empty($data['situacao_err']) &&
                    empty($data['ativo_err']) && 
                    empty($data['cor_err'])
                    ){
                      
                        try {
                                if($this->situacaoModel->register($data)){
                                    flash('message', 'Cadastro realizado com sucesso!');                     
                                    $this->view('situacoes/index',$data);
                                } else {
                                    throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                                }
        
                            } catch (Exception $e) {
                                $erro = 'Erro: '.  $e->getMessage(). "\n";
                                flash('message', $erro,'alert alert-danger');
                                $this->view('situacoes/new');
                            }                  
                        } else {
                            //Validação falhou
                            flash('message', 'Erro ao efetuar o cadastro, verifique os dados informados!','alert alert-danger');                     
                            $this->view('situacoes/new',$data);
                        }     

                } else {

                    if($_SESSION[DB_NAME . '_user_type'] != "admin"){
                        redirect('index');
                    } 

                    unset($data);                  
                    $this->view('situacoes/new', $data);
                } 
        }



        public function edit($id){            
            if((!isLoggedIn())){ 
                redirect('users/login');
            } 

            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){             
                // Process form
                
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);    


                //init data
                $data = [
                    'id' => $id,
                    'situacao' => trim($_POST['situacao']),
                    'ativo' => trim($_POST['ativo']),
                    'cor' => trim($_POST['cor']),                    
                    'situacao_err' => '',
                    'ativo_err' => '',
                    'cor_err' => ''
                ];                

                

                // Valida Situação
                if(empty($data['situacao'])){
                    $data['situacao_err'] = 'Por favor informe a Situação';
                } 

                // Valida se é ativo ou não na fila               
                if((($data['ativo'])=="") || ($data['ativo'] <> '0') && ($data['ativo'] <> '1')){
                    $data['ativo_err'] = 'Por favor informe se fica ativo na fila';
                } 

                // Valida cor
                if(empty($data['cor'])){
                    $data['cor_err'] = 'Por favor informe uma cor';
                } 
                              
                
                // Make sure errors are empty
                if(                    
                    empty($data['situacao_err']) &&
                    empty($data['ativo_err']) && 
                    empty($data['cor_err'])
                    ){
                      
                        try {
                                if($this->situacaoModel->update($data)){                                    
                                    flash('message', 'Cadastro atualizado com sucesso!');                     
                                    $this->view('situacoes/edit',$data);
                                } else {
                                    throw new Exception('Ops! Algo deu errado ao tentar atualizar os dados!');
                                }
        
                            } catch (Exception $e) {
                                $erro = 'Erro: '.  $e->getMessage(). "\n";
                                flash('message', $erro,'alert alert-danger');
                                $this->view('situacoes/edit');
                            }                  
                        } else {
                            //Validação falhou
                            flash('message', 'Erro ao tentar atualizar o cadastro, verifique os dados informados!','alert alert-danger');                     
                            $this->view('situacoes/edit',$data);
                        }
            
            } else {
                // get exiting user from the model
                $situacao = $this->situacaoModel->getSituacaoByid($id);

                if($_SESSION[DB_NAME . '_user_type'] != "admin"){
                    redirect('userlist');
                }
               

                $data = [
                    'id' => $id,
                    'situacao' => $situacao->descricao,
                    'ativo' => $situacao->ativonafila,                                      
                    'cor' => $situacao->cor                  
                ];
                // Load view
                $this->view('situacoes/edit', $data);
            } 
        }

}   
?>