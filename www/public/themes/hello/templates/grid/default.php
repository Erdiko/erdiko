<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12" role="main">
			<?php if($data->getPageTitle() != null) echo "<h1>".$data->getPageTitle()."</h1>\n"; ?>
		</div>
	</div>

      <div class="row">
        <div class="col-md-12 col-sm-12" role="main">
        	<?php
        		$data = $this->getLayoutData(); // @todo rename 'templates' folder to 'layouts'
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

