<?php require APPROOT . '/views/inc/header.php'; ?>
 <div class="row align-items-center mb-3"> 
    <div class="col-md-6">
        <h1>Usuários do sistema</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/users/new" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar
        </a>
    </div>
 </div> 
 <?php flash('register_success');?>
<table class="table table-striped">
    <thead>
        <tr>      
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $user) : ?>
            <tr>
                <td><?php echo $user->name;?></td>
                <td><?php echo $user->email;?></td>
                <td><?php  echo (($user->type == "admin")) ? 'Administrador' : 'Usuário';?></td>  
                <td><a href="<?php echo URLROOT; ?>/users/edit/<?php echo $user->id; ?>" class="fa fa-edit btn btn-success pull-right btn-sm">Editar</a></td>
                
                <td><a 
                        href="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id;?>" 
                        class="fa fa-remove btn btn-danger pull-left btn-sm"
                        onclick="if(question('Tem certeza que deseja remover o registro?') == true)
                                {
                                    document.forms[0].submit();
                                }
                                else
                                {										
                                    return false;
                                }"                       
                    >                        
                        Remover
                    </a></td>
            </tr>
        <?php endforeach; ?>   
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>