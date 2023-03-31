<?php require APPROOT . '/views/inc/header.php'; ?>
 <div class="row align-items-center mb-3"> 
    <div class="col-md-6">
        <h1>Etapas</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/etapas/new" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar
        </a>
    </div>
 </div> 
 <?php flash('register_success');?>
<table class="table table-striped">
    <thead>
        <tr>      
        <th scope="col">Descrição</th>
        <th scope="col">Data Inicial</th>
        <th scope="col">Data Final</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $etapa) : ?>
            <tr>
                <td><?php echo $etapa->descricao;?></td>
                <td><?php echo date('d/m/Y', strtotime($etapa->data_ini));?></td>
                <td><?php echo date('d/m/Y', strtotime($etapa->data_fin));?></td>                  
                <td><a href="<?php echo URLROOT; ?>/etapas/edit/<?php echo $etapa->id; ?>" class="fa fa-edit btn btn-success pull-right btn-sm">Editar</a></td>
                
                <td><a 
                        href="<?php echo URLROOT; ?>/etapas/delete/<?php echo $etapa->id;?>" 
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