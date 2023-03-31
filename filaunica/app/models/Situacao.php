<?php
//aula 31 do curso
    class Situacao {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
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
    
    }

       
?>