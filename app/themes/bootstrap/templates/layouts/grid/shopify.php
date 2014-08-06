<div class="container-fluid">
      <div class="row">
        <div role="main">
        	<?php
        		$data = $data->getData(); // temporary hack

				for($i=0; $i<count($data['products']); $i++)
				{
					$item = array(
					'size' => $data['columns'],
					'details' => array(
							'name' => $data['products'][$i]['title'],
							'image' => $data['products'][$i]['image'],
							'url' => "#"
							)
					);

					echo Erdiko::getView('examples/grid/item', $item);
				}
			?>
        </div>
  	</div>
</div>

