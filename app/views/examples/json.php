<div class="container">
    <div class="row">
    <div class="col-12" role="main">
        <?php
            // $data = $this->getData();
            $jsonString = json_encode($data, JSON_PRETTY_PRINT);
            echo "<pre>".$jsonString."</pre>";
        ?>
    </div>
    </div>
</div>