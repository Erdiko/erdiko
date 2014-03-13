<div class="container">

	<div class="row">
   		<div class="col-md-12" role="main">
        	<?php if($data->getPageTitle() != null) echo "<h1>".$data->getPageTitle()."</h1>\n"; ?>
        </div>
  	</div>

  	<div class="row">
   		<div class="col-md-12" role="main">
        	<?php echo $data->getMainContent(); ?>
        </div>
  	</div>
</div>
