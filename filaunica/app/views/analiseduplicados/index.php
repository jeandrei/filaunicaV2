<?php require APPROOT . '/views/inc/header.php'; ?>

 <table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">Posição</th>
      <th scope="col">Registro</th>
      <th scope="col">Protocolo</th>
      <th scope="col">Nome</th>
      <th scope="col">Nascimento</th>
      <th scope="col">Responsavel</th>
      <th scope="col">CPF do Responsavel</th>
      <th scope="col">Logradouro</th>      
      <th scope="col">Situação</th> 
      <th scope="col">Ações</th>      
    </tr>
  </thead>
  <tbody>
  
  <?php $currentDuplicado = 0; $cores = ['table-active','table-primary','table-success','table-danger','table-warning','table-info','table-light',]; $currentCor = 0;?>
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
    <tr class="<?php echo $cores[$currentCor];?>" style="font-size: 12px;">
      <th scope="row"><?php echo $row['posicao'];?></th>
      <td><?php echo $row['registro'];?></td>
      <td><?php echo $row['protocolo'];?></td>
      <td><?php echo $row['nomecrianca'];?></td>
      <td><?php echo $row['nascimento'];?></td>
      <td><?php echo $row['responsavel'];?></td>
      <td><?php echo $row['cpfresponsavel'];?></td>
      <td><?php echo $row['logradouro'];?></td>      
      <td><?php echo $row['situacao'];?></td>  
      <td><button type='button' class='btn btn-danger' onClick=remover(this,<?php echo $row['id'];?>)>Remover</button></td>
    </tr> 
  <?php endforeach;?>   
  </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>


<script>

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

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
   
    
   
    
   function remover(rowToDelete,id) {

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