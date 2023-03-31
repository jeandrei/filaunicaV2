<?php require APPROOT . '/views/inc/header.php';?>
<div class="row">
    <div class="col-md-6 mx-auto">
    <?php flash('register_success');?>
    <a href="<?php echo URLROOT; ?>/etapas" class="btn btn-light mt-3"><i class="fa fa-backward"></i>Back</a>
        <div class="card card-body bg-ligth mt-5">
            <h2>Registrar uma etapa</h2>
            <p>Por favor informe os dados da nova etapa</p>
            <form action="<?php echo URLROOT; ?>/etapas/new" method="post">                
                <!--DESCRIÇÃO-->
                <div class="form-group">
                <label for="descricao">Descrição: <sup>*</sup></label>
                <!--is-invalid é uma classe do bootstrap que deixa o texto em vermelho então verificamos se tem valor no name_err se sim aplicamos essa classe-->
                <input type="text" name="descricao" class="form-control form-control-lg <?php echo (!empty($data
                ['descricao_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['descricao']; ?>">
                <span class="invalid-feedback"><?php echo $data['descricao_err']; ?></span>
                </div>
                <!--DATA INICIAL-->
                <div class="form-group">
                <label for="data_ini">Data Inicial: <sup>*</sup></label>               
                <input type="date" name="data_ini" class="form-control form-control-lg <?php echo (!empty($data
                ['data_ini_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['data_ini']; ?>">
                <span class="invalid-feedback"><?php echo $data['data_ini_err']; ?></span>
                </div>
                <!--DATA FINAL-->
                <div class="form-group">
                <label for="data_fin">Data Final: <sup>*</sup></label>               
                <input type="date" name="data_fin" class="form-control form-control-lg <?php echo (!empty($data
                ['data_fin_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['data_fin']; ?>">
                <span class="invalid-feedback"><?php echo $data['data_fin_err']; ?></span>
                </div>      
                <br>
                 <!--BOTÕES-->
                 <div class="row">
                    <div class="col">                    
                        <input type="submit" value="Registrar" class="btn btn-success btn-block">                        
                    </div>                    
                 </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>