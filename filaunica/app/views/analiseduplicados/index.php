<?php require APPROOT . '/views/inc/header.php'; ?>

 <table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Registro</th>
      <th scope="col">Nome</th>
      <th scope="col">Nascimento</th>
      <th scope="col">Responsavel</th>
      <th scope="col">CPF do Responsavel</th>
      <th scope="col">Logradouro</th>      
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
    <tr class="<?php echo $cores[$currentCor];?>">
      <th scope="row"><?php echo $row['indiceDuplicado'];?></th>
      <td><?php echo $row['registro'];?></td>
      <td><?php echo $row['nomecrianca'];?></td>
      <td><?php echo $row['nascimento'];?></td>
      <td><?php echo $row['responsavel'];?></td>
      <td><?php echo $row['cpfresponsavel'];?></td>
      <td><?php echo $row['logradouro'];?></td>      
      <td>excluir</td>
    </tr> 
  <?php endforeach;?>   
  </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>