<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" id="modalConfirma" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Confirma a Exclusão do Registro?</h5>        
      </div>
      
      <form method="post" enctype="multipart/form-data"> 
        <!-- MODAL BODY-->
        <div class="modal-body"> 
            
        <form action="<?php echo URLROOT; ?>/situacoes/delete/<?php echo $data->id;?>" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <p>Você deseja realmente excluir a Situação <strong><?php echo $data->descricao; ?>?</strong></p>
        </div>  
        
        <div class="form-group mt-3">
        
        <button type="button" class="btn btn-secondary" id="btnFecharAddModel" data-dismiss="modal">Cancelar</button>
        
            <button type="submit" name="delete" id="delete" class="btn btn-primary">Confirmar</button>
        </div>

    </form>



        </div>
        <!-- FIM MODAL BODY -->

        <!-- BOTÕES -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btnFecharAddModel" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id='confirma' data-dismiss="modal">Confirmar</button>
        </div>
        <!-- FIM BOTÕES -->
      </form>
      
    </div>
  </div>
  
</div>
<!-- MODAL -->