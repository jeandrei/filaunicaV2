<?php require APPROOT . '/views/inc/header.php'; ?>

 <div class="row align-items-center mb-3"> 
    <div class="col-md-10">
        <h2>Escolas do usuário <?php echo $data['user']->name;?></h2>
    </div>
    <div class="col-md-2">
        <a href="<?php echo URLROOT; ?>/usuarioescolas/new/<?php echo $data['user']->id;?>" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar
        </a>
    </div>
 </div> 
 <?php flash('message');?>
<table class="table table-striped">
    <thead>
            <tr class="text-center">      
            <th class="col-sm-4">Escola</th>            
            <th class="col-sm-3">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if($data['escolasusuario']) : ?>
            <?php foreach($data['escolasusuario'] as $escola) : ?>
                <tr class="text-center">
                    <td><?php echo $escola->nome;?></td>

                    <td>   

                        <a 
                            href="<?php echo URLROOT; ?>/usuarioescolas/delete/<?php echo $escola->id;?>" 
                            class="fa fa-remove btn btn-danger pull-left btn-sm"
                        >                        
                            Remover
                        </a>

                    </td>                
                    
                </tr>
            <?php endforeach; ?> 
        <?php else : ?>
            <tr>
                <td colspan="6" class="text-center">
                    Nenhuma escola vinculada
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>



