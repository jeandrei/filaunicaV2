<?php

require APPROOT . '/views/inc/fpdf/fpdf.php'; 

class PDF extends FPDF
{            
            
            // Page header
            function Header()
            {   $currentdate = date("d-m-Y");
                // Logo
                $this->Image(APPROOT . '/views/inc/logo.png',10,6,110);
                // Date
                $this->SetFont('Arial','B',10); 
                $this->Cell(120);
                $this->Cell(260,10, utf8_decode('Data de impressão: ' . $currentdate),0,0,'C');
                // Arial bold 15
                $this->SetFont('Arial','B',15);    
                // Title
                $this->Ln(20);
                // Move to the right
                $this->Cell(120);
                $this->Cell(30,10, utf8_decode("Lista de Classificação da Fila Única"),0,0,'C');
                // Line break
                $this->Ln(20);                
            }

            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
            }
}

            // Instanciation of inherited class
            $pdf = new PDF();
            //$pdf->AliasNbPages();
            $pdf->SetFont('Times','',12);
            //$pdf = new FPDF();
            //AddPage('P') RETRATO AddPage('L') PAISAGEM
            //$pdf->AddPage('L');            
            $pdf->SetFont('Arial','B',8);
            $colunas =array("Pos", "Registro", "Responsável pelo cadastro", "Iniciais da Criança", "Nascimento", "Etapa", "Protocolo");
            //largura das colunas
            $larguracoll = array(1 => 10, 2 => 40, 3 => 120, 4 => 30, 5 => 20, 6 => 25, 7 => 35);
            $tam_fonte = 10;    
            
            
            
            
            //pega as etapas
            $etapas = $this->etapaModel->getEtapas();

           
           
           
            //para cada etapa que retornar no banco de dados
            foreach($etapas as $etapa){ 
                
                //se existir registros na etapa com status aguardando 1 é a situação aguardando
                if($registros = $this->filaModel->getFilaPorEtapaRelatorio($etapa['id']))
                {   //guarda os registros na variável registros
                    $registros = $this->filaModel->getFilaPorEtapaRelatorio($etapa['id']);                                    
                }
                else
                {
                    $registros = NULL;
                }

                //se tiver valores em registro vai imprimir todas as linhas da etapa lá do foreach
                if($registros <> NULL ){
                    //adiciona uma nova pagina
                    $pdf->AddPage('L');
                    //SETA A FONTE PARA TAMANHO 8 NEGRITO
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell(0, 5,utf8_decode("Listagem " . $etapa['descricao']), 0, 1, "C");                    
                    $i=0;
                    
                    foreach($colunas as $coluna){
                        $i++;
                        $pdf->SetFont('Arial','B',8);                   
                        $pdf->Cell($larguracoll[$i],$tam_fonte,utf8_decode($coluna),1);
                    }

                    foreach($registros as $row) {       
                        $pdf->SetFont('Arial','',8);        
                        $pdf->Ln();
                        $i=0;
                        foreach($row as $column){
                            $i++;   
                            //se a coluna for a de número 3 quer dizer que é o nome então executa a função iniciais
                            if($i == 4){
                                $pdf->Cell($larguracoll[$i],$tam_fonte,utf8_decode(iniciais($column)),1);
                            }
                            else
                            {
                                $pdf->Cell($larguracoll[$i],$tam_fonte,utf8_decode($column),1); 
                            }
                        }
                    } 
                }
                else
                {
                    $error = "Sem dados para emitir";
                }    

            }//END FOREACH 

           
            
              


            if($pdf->Output())
            {
                $pdf->Output();  
            }
            else{
                echo $data['erro'] = $error;
                $this->view('listas/erroAoGerarRelatorio',$data);
                
            }            
?>

