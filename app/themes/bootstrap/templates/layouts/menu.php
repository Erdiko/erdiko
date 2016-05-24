<div class="container">
    <div class="row">
        <h1>Basic usage</h1>
        <div class="col-md-3" id="column-left">
        <?php
            $data = $this->getData();

            echo $data['example']
        ?>
        </div>
    </div>

    <div class="row">
        <h1>Shopify example</h1>
        <div class="col-md-3" id="column-left">
            <?php
                echo $data['shopify']
            ?>
        </div>
    </div>
</div>