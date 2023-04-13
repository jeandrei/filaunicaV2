<?php require APPROOT . '/views/inc/header.php'; ?>
 
  
  <?php $currentDuplicado = 0; $cores = ['#ff0000','#8000ff','#00bfff','#ffbf00','#ffff00','#80ff00','#4d4d4d']; $currentCor = 0;?>
  <?php foreach($data as $row) : ?>
    <?php 
          if($currentDuplicado <> $row['indiceDuplicado']){
            $currentDuplicado = $row['indiceDuplicado'];
            $currentCor++;
            if($currentCor>6){
              $currentCor = 0;
            }
          } 
    ?>
    <!-- aqui vou montar a tabela -->
    <div class="container" style="font-size: 12px;">
      <div class="row border-top border-right">
        <!-- cor da lateral de cada linha -->
        <div style="border-left: 10px solid <?php echo $cores[$currentCor];?>;"></div>

        <div class="col-1"><button type='button' class='btn btn-danger btn-sm' onClick=remover(this,<?php echo $row['id'];?>)>Remover</button></div>
        <div class="col-1 text-center border-left"><?php echo $row['posicao'];?></div>
        <div class="col-2 border-left">Registro: <?php echo $row['registro'];?></div>
        <div class="col-4 border-left">Nome: <?php echo $row['nomecrianca'];?></div>
        <div class="col-1 border-left">Nascimento: <?php echo $row['nascimento'];?></div>
      </div>
    </div>
       

  <?php endforeach;?>   
  </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>


<script>

/* delete a linha da tabela sem relação com o banco de dados */
function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

/* retorna os dados de um registro do banco de dados para o javascript */
function getRegistro(id){    
  $.ajax({
    url: `<?php echo URLROOT; ?>/filas/getRegistro/${id}`,
      method:'POST',         
      async: false,
      dataType: 'json'
    }).done(function (response){
      ret_val = response;
    }).fail(function (jqXHR, textStatus, errorThrown) {
      ret_val = null;
    });
   return ret_val;
}
   
    
   
// Remove um registro da fila e remove a linha da tabela   
function remover(rowToDelete,id) {
  //pego o registro a partir do id lá do banco de dados
  let registro = getRegistro(id);      
  
  const confirma = confirm(`Tem certeza que deseja excluir o protocolo ${registro.protocolo} da criança ${registro.nomecrianca}?`);
  if(confirma){
    $.ajax({  
        url: `<?php echo URLROOT; ?>/filas/delete/${id}`,                
        method:'POST',
        success: function(retorno_php){                     
            var responseObj = JSON.parse(retorno_php); 
            if(responseObj.error == false){
              deleteRow(rowToDelete);
            } else {
              alert(responseObj.message);
            }
                            
        }     
    });//Fecha o ajax      
  }      
}

  
</script>