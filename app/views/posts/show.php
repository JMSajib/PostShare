<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br><br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written By <strong><?php echo $data['user']->name ?></strong> on <?php echo $data['post']->created_at ?>
</div>
<h3><?php echo $data['post']->body; ?></h3><hr>
<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id ?>" 
        class="btn btn-dark"><i class="fa fa-edit"></i> Edit</a>
    <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>"
         method="post">
         <button type="sumbit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
    </form>    

<?php endif; ?>    

<?php require APPROOT . '/views/inc/footer.php'; ?>