<div class="container">
	<div class="row">
		<div class="col-md-6" id="column-left"><?php echo $data->getSidebar('left'); ?></div>
 		<div class="col-md-6" id="column-main">
 			<?php if($data->getPageTitle() != null) echo "<h1>".$data->getPageTitle()."</h1>\n"; ?>
 			<?php echo $data->getMainContent(); ?>
 		</div>
	</div>
</div>
