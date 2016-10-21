<div class="container">
	<?php if(!empty( $this->getTitle() )):?>
    <div class="row">
        <div class="col-12">
            <h1><?php echo $this->getTitle() ?></h1>
        </div>
    </div>
	<?php endif ?>
    <div class="row">
        <div class="col-lg-12" role="main">
            <?php echo $this->getRegion('body') ?>    
        </div>
    </div>
</div>