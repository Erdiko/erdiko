<?php $messages = \erdiko\core\helpers\FlashMessages::get() ?>
<?php if(!empty($messages)): ?>
	<div class="container">
      <div class="msgs-header">
        <div class="row">
          <div class="col-lg-12 col-md-12">

	<?php foreach($messages as $message): ?>
		<div class="alert alert-<?php echo $message['type'] ?> alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <?php echo $message['text'] ?>
		</div>
	<?php endforeach ?>

		  </div>
	    </div>
	  </div>
	</div>

<?php endif ?>