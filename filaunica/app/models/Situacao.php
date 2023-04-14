<?php
//aula 31 do curso
    class Situacao {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }



        // Registra Situação
        public function register($data){
            $this->db->query('INSERT INTO situacao (descricao, cor, ativonafila) VALUES (:descricao, :cor, :ativonafila)');
            // Bind values
            $this->db->bind(':descricao',$data['descricao']);
            $this->db->bind(':cor',$data['cor']);
            $this->db->bind(':ativonafila',$data['ativo']);            

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Update Situacao
        public function update($data){
            
            $this->db->query('UPDATE situacao SET descricao = :descricao, cor = :cor, ativonafila = :ativonafila WHERE id = :id');
            // Bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':descricao',$data['descricao']);   
            $this->db->bind(':ativonafila',$data['ativo']);         
            $this->db->bind(':cor',$data['cor']);            

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

         // Deleta situacao por id
         public function delete($id){
            $this->db->query('DELETE FROM situacao WHERE id = :id');
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

       

        

        // RETORNA A SITUAÇÃO POR ID
        public function getDescricaoSituacaoById($id) {  
            //pega o id da etapa
            $this->db->query("SELECT * FROM situacao WHERE id = :id");
            $this->db->bind(':id',$id);                  
            $situacao =$this->db->single();  
            if(!empty($situacao->id)){
                return $situacao->descricao;
            }
            else{
                return false;
            }
        
        }

          // RETORNA A SITUAÇÃO POR ID
          public function getCorSituacaoById($id) {  
            //pega o id da etapa
            $this->db->query("SELECT * FROM situacao WHERE id = :id");
            $this->db->bind(':id',$id);                  
            $situacao =$this->db->single();  
            if(!empty($situacao->id)){
                return $situacao->cor;
            }
            else{
                return false;
            }
        
        }


        //Traz todas as situações da tabela situacao
        public function getSituacoes(){
            $this->db->query('SELECT * FROM situacao');          
           
            return $this->db->resultSet();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

        //Traz a situação pelo id
        public function getSituacaoByid($id){
            $this->db->query('SELECT * FROM situacao WHERE id = :id');          
            $this->db->bind(':id',$id);  
            $situacao =$this->db->single();  

            // Check row
            if($this->db->rowCount() > 0){
                return $situacao;
            } else {
                return false;
            }
        }
    
    }


    



       
?>