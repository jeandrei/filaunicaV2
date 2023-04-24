<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
    <a href="<?php echo URLROOT; ?>/users" class="btn btn-light mt-3"><i class="fa fa-backward"></i>Voltar</a>
        <div class="card card-body bg-ligth mt-5">
            <h2>Atualizar usuário</h2>
            <p>Por favor informe os dados do usuário</p>
            <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['id']; ?>" method="post">                
                
                <!--NOME-->
                <div class="form-group">
                    <label for="name">Nome: <sup>*</sup></label>
                    <!--is-invalid é uma classe do bootstrap que deixa o texto em vermelho então verificamos se tem valor no name_err se sim aplicamos essa classe-->
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control form-control-lg <?php echo (!empty($data
                    ['name_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $data['name']; ?>">
                    <span class="text-danger">
                        <?php echo $data['name_err']; ?>
                    </span>
                </div>
                
                <!--EMAIL-->
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>               
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control form-control-lg  <?php echo (!empty($data
                    ['email_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $data['email']; ?>" readonly>
                    <span class="text-danger">
                        <?php echo $data['email_err']; ?>
                    </span>
                </div>
                
                <!--PASSWORD-->
                <div class="form-group">
                    <label for="password">Senha: <sup>*</sup></label>               
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control form-control-lg <?php echo (!empty($data
                    ['password_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo (!empty($data['password'])) ? $data['password'] : ''; ?>">
                    <span class="text-danger">
                        <?php echo $data['password_err']; ?>
                    </span>
                </div>
                
                <!--CONFM PASSWORD-->
                <div class="form-group">
                    <label for="confirm_password">Confirma: <sup>*</sup></label>                
                    <input 
                        type="password" 
                        name="confirm_password" 
                        class="form-control form-control-lg <?php echo (!empty($data
                    ['confirm_password_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo (!empty($data['confirm_password'])) ? $data['confirm_password'] : ''; ?>">
                    <span class="text-danger">
                        <?php echo $data['confirm_password_err']; ?>
                    </span>                
                </div>
               
                
                <!--TIPO DO USUÁRIO-->                
                <div class="form-group">
                        <div class="form-group custom-control custom-radio custom-control-inline">
                            <input 
                                type="radio" 
                                id="admin" 
                                name="type" 
                                value="admin"
                                class="custom-control-input"
                                <?php echo ((isset($data['type'])) && ($data['type'] == "admin")) ? 'checked="checked"' : ''; ?>
                            >
                            <label class="custom-control-label" for="admin">Admin </label>
                        </div>
                        
                        <div class="custom-control custom-radio custom-control-inline">
                            <input 
                                type="radio" 
                                id="user" 
                                name="type" 
                                value="user"
                                class="custom-control-input"
                                <?php echo ((isset($data['type'])) && ($data['type'] == "user")) ? 'checked="checked"' : ''; ?>
                            >
                            <label class="custom-control-label" for="user">Usuário</label>
                        </div>
                        
                        <div class="custom-control custom-radio custom-control-inline">
                            <input 
                                type="radio" 
                                id="sec" 
                                name="type"
                                value="sec" 
                                class="custom-control-input"
                                <?php echo ((isset($data['type'])) && ($data['type'] == "sec")) ? 'checked="checked"' : ''; ?>
                            >
                            <label class="custom-control-label" for="sec">Secretário de escola</label>
                        </div>
                    <span class="text-danger">
                        <?php echo $data['type_err']; ?>
                    </span>
                </div>


                <br>
                 <!--BOTÕES-->
                 <div class="row">
                    <div class="col-3 text-end p-1">                    
                        <input type="submit" value="Atualizar" class="btn btn-success">                        
                    </div>  
                    
                    <div class="col-7 text-start p-1">                    
                        <a href="<?php echo URLROOT; ?>/escolas/usuarioescola/<?php echo $data['id']; ?>" class="btn btn-success">Vincular Escola</a>                        
                    </div>  
                 </div>
                 
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>