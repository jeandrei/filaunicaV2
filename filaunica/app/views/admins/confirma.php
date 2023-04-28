<?php require APPROOT . '/views/inc/header.php';?>
<main>
  
    <h2 class="mt-2">Deseja remover uma vaga do quadro de vagas?</h2>

    <form action="<?php echo URLROOT; ?>/admins/edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" id="escola_id" name="escola_id" value="<?php echo $data['escola_id'];?>" />
        <div class="form-group">
            <p>Você deseja atualizar o quadro e vagas da escola <strong><?php echo $data['unidade_matricula']; ?></strong> e etapa <strong><?php echo $data['etapa']; ?></strong></p>             
        </div>  
        
        <div class="form-group mt-3">
        
            <a class="btn btn-success" href="<?php echo URLROOT ?>/pages/sistem">
            Cancelar
            </a>
        
            <button type="submit" name="botao" id="botao" value="atualizavaga" class="btn btn-danger">Atualizar</button>
        </div>

    </form>

</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>