<div class="container">

	<div class="row">
   		<div class="text-center">
        <?php if($data->getPageTitle() != null) echo "<h1>".$data->getPageTitle()."</h1>\n"; ?>
  	</div>
  </div>
  
  <div class="row">
    <div class="col-lg-12" class="main-content" role="main">
      <?php echo $data->getMainContent(); ?>
    </div>
  </div>

</div>