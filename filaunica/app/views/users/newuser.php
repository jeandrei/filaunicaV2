<?php require APPROOT . '/views/inc/header.php';?>
<div class="row">
    <div class="col-md-6 mx-auto">
    <?php flash('register_success');?>
    <a href="<?php echo URLROOT; ?>/users" class="btn btn-light mt-3"><i class="fa fa-backward"></i>Back</a>
        <div class="card card-body bg-ligth mt-5">
            <h2>Registrar um usuário</h2>
            <p>Por favor informe os dados do novo usuário</p>
            <form action="<?php echo URLROOT; ?>/users/new" method="post">                
                <!--NOME-->
                <div class="form-group">
                <label for="name">Nome: <sup>*</sup></label>
                <!--is-invalid é uma classe do bootstrap que deixa o texto em vermelho então verificamos se tem valor no name_err se sim aplicamos essa classe-->
                <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data
                ['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>
                <!--EMAIL-->
                <div class="form-group">
                <label for="email">Email: <sup>*</sup></label>               
                <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data
                ['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <!--PASSWORD-->
                <div class="form-group">
                <label for="password">Senha: <sup>*</sup></label>               
                <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data
                ['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <!--CONFM PASSWORD-->
                <div class="form-group">
                <label for="confirm_password">Confirma: <sup>*</sup></label>                
                <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data
                ['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>                
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="type" name="type" value="1" <?php echo ((isset($data['type'])) && ($data['type'] == "admin")) ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="admin">Administrador</label>
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