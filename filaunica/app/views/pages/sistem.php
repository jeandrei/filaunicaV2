<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('message');?>

<div class="jumbotron jumbtron-fluid text-center">
<div class="container">
<h1 class="display-3"><?php echo $data['title']; ?></h1>
<p class="lead"><?php echo $data['description'];?></p>
</div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

