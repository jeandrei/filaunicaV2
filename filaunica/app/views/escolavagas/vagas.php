<?php require APPROOT . '/views/inc/header.php';?>

<div class="row">
    <div class="col-md-6 mx-auto">
    <?php flash('message');?>
    <a href="<?php echo URLROOT; ?>/pages/sistem" class="btn btn-light mt-3"><i class="fa fa-backward"></i>Voltar</a>
        <div class="card card-body bg-ligth mt-5">
          <h2>Vagas por etapa</h2>
          <p>Informe a quantidade de vagas por etapa</p>
          <form action="<?php echo URLROOT; ?>/escolavagas/vagas" method="post"> 
              <table class="table table-striped">
                <thead>
                  <tr>                  
                    <th class="w-75">Etapa</th>
                    <th class="w-25 text-left">Quantidade</th>                  
                  </tr>
                </thead>
                <tbody>                            
                    <?php foreach($data['etapas'] as $key => $etapa) : ?>
                      <tr>                      
                        <td>
                            <?php echo $etapa['descricao'];?>
                        </td>
                        <td>
                          <input 
                            type="text"
                            name="<?php echo $etapa['id'];?>"
                            id="<?php echo $etapa['id'];?>"
                            class="form-control form-control-sm col-2"
                            value="<?php echo $_POST[$etapa['id']];?>"
                          >
                        </td>                      
                      </tr>      
                    <?php endforeach; ?>                
                </tbody>
                </table>    
                
                <span class="text-danger">
                      <?php echo $data['post']['escola_id_err']; ?>
                </span>
                
                <!--BOTÕES-->
                <div class="row mt-3">
                    <div class="col">                    
                        <input type="submit" value="Gravar" class="btn btn-success btn-block">                        
                    </div>                    
                </div>
                <!--BOTÕES-->
          </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>

