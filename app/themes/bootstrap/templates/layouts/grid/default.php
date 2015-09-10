<div class="container-fluid">
    <div class="row">
        <div role="main">
            <?php
                $data = $data->getData(); // temporary hack

                $item = array(
                'size' => $data['columns'],
                'details' => array(
                'name' => "Example Item",
                'image' => "http://placehold.it/180x180/BBBBBB/EEEEEE&text=Grid+Item",
                'url' => "#")
                );

                for ($i=0; $i<$data['count']; $i++) {
                    echo Erdiko::getView('examples/grid/item', $item);
                }
            ?>
        </div>
    </div>
</div>

