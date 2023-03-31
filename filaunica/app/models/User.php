<?php
//aula 31 do curso
    class User {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

        // Register User
        public function register($data){
            $this->db->query('INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, :type)');
            // Bind values
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':password',$data['password']);
            $this->db->bind(':type',$data['type']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

         // Update User
         public function update($data){
            $this->db->query('UPDATE users SET name = :name, password = :password, type =:type WHERE email = :email');
            // Bind values
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':name',$data['name']);            
            $this->db->bind(':password',$data['password']);
            $this->db->bind(':type',$data['type']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // 2 Login User                
        public function login($email, $password){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            // password_verify — Verifica se um password corresponde com um hash criptografado
            // Logo para verificar não precisa descriptografar 
            // aqui $password vem do formulário ou seja digitado pelo usuário  
            // e $hashed_password vem da consulta do banco e está criptografado
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        // Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            // Bind value
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

         // Find user by email
         public function delUserByid($id){
            $this->db->query('DELETE FROM users WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);

            $row = $this->db->execute();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

        

        // Find user by email
        public function getUsers(){
            $this->db->query('SELECT * FROM users');            

            return $this->db->resultSet();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

         // Find user by email
         public function getUserById($id_user){
            $this->db->query('SELECT * FROM users WHERE id = :id');      
            
            $this->db->bind(':id', $id_user);

            return $this->db->single();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

    }
?>