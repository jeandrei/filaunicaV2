<?php
    class Users extends Controller{
        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->userModel = $this->model('User');
        }

        public function index() {

            if($_SESSION[DB_NAME . '_user_type'] != "admin"){
                redirect('index');
            } else if($data = $this->userModel->getUsers()){  
                $this->view('users/userslist', $data);
            } else {                
                flash('register_success', 'Falha ao carregar a lista de usuários!', 'alert alert-danger'); 
                $this->view('users/userslist', $data=0);
            }
            
           
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
                
                /*
                if (isset($_POST['type']) && ($_POST['type'] == 1)){
                    $type = "admin";
                } else {
                    $type = "user";
                }
                */


                //init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),                    
                    'type' => $type,
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];                

                

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Por favor informe seu email';
                } else {
                    // Check email userModel foi instansiado na construct
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email já existente'; 
                    }
                }

                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Por favor informe seu nome';
                }

                 // Validate Password
                 if(empty($data['password'])){
                    $data['password_err'] = 'Por favor informe a senha';
                } elseif (strlen($data['password']) < 6){
                    $data['password_err'] = 'Senha deve ter no mínimo 6 caracteres';
                }

                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Por favor confirme a senha';
                } else {
                    if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Senha e confirmação de senha diferentes';    
                    }
                }
               

                // Make sure errors are empty
                if(                    
                    empty($data['email_err']) &&
                    empty($data['name_err']) && 
                    empty($data['password_err']) &&
                    empty($data['confirm_password_err']) 

                    ){
                      //Validated
                      
                      // Hash Password criptografa o password
                      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                      // Register User
                      if($this->userModel->register($data)){
                        // Cria a menságem antes de chamar o view va para 
                        // views/users/login a segunda parte da menságem
                        flash('register_success', 'Usuário registrado com sucesso!');                        
                        redirect('users/userlist');
                      } else {
                          die('Ops! Algo deu errado.');
                      }
                      

                      
                    } else {
                      // Load the view with errors                     
                      $this->view('users/newuser', $data);
                    }               

            
            } else {   
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'type' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'erro' => ''
                ];
                if($_SESSION[DB_NAME . '_user_type'] != "admin"){
                    redirect('index');
                } else {
                     // Load view
                    $this->view('users/newuser', $data);
                }
               
                
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
                /*
                if (isset($_POST['type']) && ($_POST['type'] == 1)){
                    $type = 'admin';
                } else {
                    $type = 'user';
                }
                */
                //init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'type' => $type,
                    'name_err' => '',                    
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];                

               
                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Por favor informe seu nome';
                }

                 // Validate Password
                 if(empty($data['password'])){
                    $data['password_err'] = 'Por favor informe a senha';
                } elseif (strlen($data['password']) < 6){
                    $data['password_err'] = 'Senha deve ter no mínimo 6 caracteres';
                }

                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Por favor confirme a senha';
                } else {
                    if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Senha e confirmação de senha diferentes';    
                    }
                }

                // Make sure errors are empty
                if(   
                    empty($data['name_err']) && 
                    empty($data['password_err']) &&
                    empty($data['confirm_password_err'])                    
                    ){
                      //Validated
                      
                      // Hash Password criptografa o password
                      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                      // Register User
                      if($this->userModel->update($data)){
                        // Cria a menságem antes de chamar o view va para 
                        // views/users/login a segunda parte da menságem                        
                        flash('register_success', 'Usuário atualizado com sucesso!');                                                                   ;
                        redirect('users/userlist');
                      } else {
                          die('Ops! Algo deu errado.');
                      }    
                      
                    } else {
                      // Load the view with errors
                      $this->view('users/userlist', $data);
                    }              
                          
            } else {
                // get exiting user from the model
                $user = $this->userModel->getUserByid($id);

                if($_SESSION[DB_NAME . '_user_type'] != "admin"){
                    redirect('index');
                }
               

                $data = [
                    'id' => $id,
                    'name' => $user->name,
                    'email' => $user->email,                                      
                    'type' => $user->type                  
                ];

                if($_SESSION[DB_NAME . '_user_type'] != "admin"){
                    redirect('index');
                } else {
                // Load view
                    $this->view('users/edituser', $data);
                }
            } 
        }


        public function delete($id){ 

            if((!isLoggedIn())){ 
                redirect('users/login');
            } 
            
            if($_SESSION[DB_NAME . '_user_type'] != "admin"){
                redirect('index');
            } else if ($this->userModel->getUserById($id)){
                $this->userModel->delUserByid($id); 
            } else {
                $data['erro'] = "Não foi possível excluir o usuário com este id";
            }
            
            if($data = $this->userModel->getUsers()){
                $data = $this->userModel->getUsers();
            } else {
                $data['erro'] = "Falha ao carregar a lista de usuários";
            }

           

            if(empty($data['erro'])){
                    flash('register_success', 'Usuário removido com sucesso!');  
                    $this->view('users/userslist', $data);
                }
                 else {
                    flash('register_success', $data['erro'], 'alert alert-danger');
                    $this->view('users/userslist', $data); 
                 }
        }
            

        public function login(){          
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //init data
                $data = [                    
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),  
                    'email_err' => '',
                    'password_err' => ''
                    
                ];      

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Por favor informe seu email';
                } else {
                    // Check for user/email
                    if($this->userModel->findUserByEmail($data['email'])){
                        // User found
                    } else {
                    $data['email_err'] = 'Usuário não encontrado';
                    }
                }
               

                 // Validate Password
                 if(empty($data['password'])){
                    $data['password_err'] = 'Por favor informe sua senha';
                } 

                
                               
                // Make sure errors are empty
                if(                    
                    empty($data['email_err']) &&                     
                    empty($data['password_err'])                     
                    ){
                      //Validate
                      // 1 Check and set loged in user
                      // 2 models/User login();
                      $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                      
                      if($loggedInUser){
                        // Create Session 
                        // função no final desse arquivo
                        $this->createUserSession($loggedInUser);
                      } else {
                          $data['password_err'] = 'Senha incorreta';

                          $this->view('users/login', $data);
                      }
                    } else {
                      // Load the view with errors
                      $this->view('users/login', $data);
                    }               

            
            } else {
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                // Load view
                $this->view('users/login', $data);
            }
    }

    public function createUserSession($user){
        // $user->id vem do model na função login() retorna a row com todos os campos
        // da consulta na tabela users
        $_SESSION[DB_NAME . '_user_id'] = $user->id;
        $_SESSION[DB_NAME . '_user_email'] = $user->email;
        $_SESSION[DB_NAME . '_user_name'] = $user->name;
        $_SESSION[DB_NAME . '_user_type'] = $user->type;        
        redirect('pages/sistem');
        //redirect('admins/index');
    }

    public function logout(){
        unset($_SESSION[DB_NAME . '_user_id']);
        unset($_SESSION[DB_NAME . '_user_email']);
        unset($_SESSION[DB_NAME . '_user_name']);
        unset($_SESSION[DB_NAME . '_user_type']);
        session_destroy();
        redirect('pages/login'); 
    }

    public function isLoggedIn(){
        if(isset($_SESSION[DB_NAME . '_user_id'])){
            return true;
        } else {
            return false;
        }
    }
}   
?>