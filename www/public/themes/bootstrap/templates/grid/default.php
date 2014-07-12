<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" role="main">
			<?php 
				$title = $this->getPageTitle();
		 		if(!empty($title))
		    		echo "<h1>".$title."</h1>\n";

		    	$data = $this->getLayoutData(); // @todo rename 'templates' folder to 'layouts'
		    	// error_log("data: ".print_r($data, true));
			?>
		</div>
	</div>

      <div class="row">
        <div class="col-md-12" role="main">
        	<?php
				$item = array(
					'size' => $data['columns'],
					'details' => array(
						'name' => "Example Item",
						'image' => "http://placehold.it/180x180/BBBBBB/EEEEEE&text=Grid+Item",
						'url' => "#")
					);

				for($i=0; $i<$data['count']; $i++)
				{
					echo Erdiko::getView($item, '/grid/item.php');
				}
			?>
        </div>
  	</div>
</div>

