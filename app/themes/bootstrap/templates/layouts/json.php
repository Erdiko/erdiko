<div class="container-fluid">
      <div class="row">
        <div role="main">
        	<?php
        		$data = $data->getData(); // temporary hack

				$json_string = json_encode($data, JSON_PRETTY_PRINT);
            	echo "<pre>".$json_string."</pre>";
			?>
        </div>
  	</div>
</div>

