<div class="container">
	<div class="row">
	    <div class="col-12"><h1>Grid of Objects</h1></div>
	</div>
	<div class="row">
        <div class="col-12">
            <?php
                $item = array(
                'size' => $data['columns'],
                'details' => array(
                'name' => "Example Item",
                'image' => "/images/grid-item.png",
                'url' => "#")
                );

                // Nested view, insert a themed item using a view 
                for ($i=0; $i<$data['count']; $i++) {
                    echo $this->getView('examples/grid/item', $item);
                }
            ?>
        </div>
    </div>
</div>
