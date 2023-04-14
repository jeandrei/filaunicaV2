<?php require APPROOT . '/views/inc/header.php'; ?>
 <div class="row align-items-center mb-3"> 
    <div class="col-md-10">
        <h1>Situações</h1>
    </div>
    <div class="col-md-2">
        <a href="<?php echo URLROOT; ?>/situacoes/new" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar
        </a>
    </div>
 </div> 
 <?php flash('register_success');?>
<table class="table table-striped">
    <thead>
        <tr class="text-center">      
            <th class="col-sm-2">Descrição</th>
            <th class="col-sm-2">Permanece na fila</th>
            <th class="col-sm-2">Cor</th>
            <th class="col-sm-3">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $row) : ?>
            <tr class="text-center">
                <td><?php echo $row['situacao'];?></td>
                <td><?php echo $row['ativo'];?></td>
                <td style="background-color:<?php echo $row['cor'];?>;"></td>
                                 
                <td>
                    <a 
                        href="<?php echo URLROOT; ?>/situacoes/edit/<?php echo $row['situacaoId']; ?>" class="fa fa-edit btn btn-success pull-right btn-sm">Editar
                    </a>
                
                    <a 
                        href="<?php echo URLROOT; ?>/situacoes/delete/<?php echo $row['situacaoId'];?>" 
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
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>   
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>