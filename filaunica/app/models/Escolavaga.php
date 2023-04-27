<?php
    class Escolavaga {
        private $db;

        public function __construct(){
            //inicia a classe Database
            $this->db = new Database;
        }


        
        public function escolaVagasModel($escola_id){
            $this->db->query('SELECT * FROM escola_vagas WHERE escola_id = :escola_id');            

            $this->db->bind(':escola_id', $escola_id);

            $result = $this->db->resultSet();

            // Check row
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }
        }

        public function existeEscolaVaga($escola_id, $etapa_id){
            $this->db->query('SELECT * FROM escola_vagas WHERE escola_id = :escola_id AND etapa_id = :etapa_id');            

            $this->db->bind(':escola_id', $escola_id);
            $this->db->bind(':etapa_id', $etapa_id);
            $result = $this->db->single(); 

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

        // Registra Escolavaga
        public function register($escola_id,$etapa_id,$qtd){    

            if($this->existeEscolaVaga($escola_id, $etapa_id)){
                //UPDATE
                $this->db->query('UPDATE escola_vagas SET qtd = :qtd WHERE etapa_id = :etapa_id AND escola_id = :escola_id');
            } else {
                //REGISTER
                $this->db->query('INSERT INTO escola_vagas (etapa_id, escola_id, qtd) VALUES (:etapa_id, :escola_id, :qtd)');
            }

            
            // Bind values
            $this->db->bind(':etapa_id',$etapa_id);
            $this->db->bind(':escola_id',$escola_id);
            $this->db->bind(':qtd',$qtd);                          

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }



        public function getEscolaVagas($escola_id){
            $this->db->query('SELECT e.id as id, e.descricao as descricao, ev.qtd as qtd FROM etapa e, escola_vagas ev WHERE e.id = ev.etapa_id AND ev.escola_id = :escola_id');            

            $this->db->bind(':escola_id', $escola_id);

            $result = $this->db->resultSet();

            // Check row
            if($this->db->rowCount() > 0){
                return $result;
            } else {
                return false;
            }   
        }

        
    }//etapa
    
?>