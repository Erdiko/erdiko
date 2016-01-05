<div class="container-fluid">
    <div class="row">
    <div role="main">
        <?php
            $data = $data->getData();
            $jsonString = json_encode($data, JSON_PRETTY_PRINT);
            echo "<pre>".$jsonString."</pre>";
        ?>
    </div>
    </div>
</div>
