<?php
    class Escola {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }

        // Registra Etapa
        public function register($data){            
            $this->db->query('INSERT INTO escola (nome, bairro_id, logradouro, numero, emAtividade) VALUES (:nome, :bairro_id, :logradouro, :numero, :emAtividade)');
            // Bind values
            $this->db->bind(':nome',$data['nome']);
            $this->db->bind(':bairro_id',$data['bairro_id']);
            $this->db->bind(':logradouro',$data['logradouro']); 
            $this->db->bind(':numero',$data['numero']);  
            $this->db->bind(':emAtividade',$data['emAtividade']);             

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Update Escola
        public function update($data){             
            
            $this->db->query('UPDATE escola SET nome = :nome, bairro_id = :bairro_id, logradouro = :logradouro, numero = :numero, emAtividade = :emAtividade WHERE id = :id');
            // Bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':nome',$data['nome']);            
            $this->db->bind(':bairro_id',$data['bairro_id']);
            $this->db->bind(':logradouro',$data['logradouro']);
            $this->db->bind(':numero',$data['numero']);
            $this->db->bind(':emAtividade',$data['emAtividade']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

         // Deleta etapa por id
         public function delEtapaByid($id){
            $this->db->query('DELETE FROM escola WHERE id = :id');
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

         // RETORNA O NOME DE UMA ESCOLA A PARTIR DE UM ID
         public function getNomeEscola($id) {
            $this->db->query("SELECT nome FROM escola WHERE id = :id");
            $this->db->bind(':id', $id);    
            $row = $this->db->single();           

            if($this->db->rowCount() > 0){
                return $row->nome;
            } else {
                return false;
            } 
        }
       

        

        // RETORNA TODAS AS ESCOLAS
        public function getEscolas() {
            $this->db->query('SELECT * FROM escola');            

            $result = $this->db->resultSet();

            // Check row
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }
        } 
     
         // Busca etapa por id
         public function getEscolaByid($id){
            $this->db->query('SELECT * FROM escola WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0){
                return $row;
            } else {
                return false;
            }
        }         

    }//etapa
    
?>