<div class="container">
    <div class="row">
        <div class="col-12">
            <h1><?php echo $this->getTitle() ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-xs-12" id="column-left"><?php echo $this->getRegion('one') ?></div>
    	<div class="col-lg-4 col-sm-4 col-xs-12" id="column-main"><?php echo $this->getRegion('two') ?></div>
    	<div class="col-lg-4 col-sm-4 col-xs-12" id="column-right"><?php echo $this->getRegion('three') ?></div>
    </div>
</div>
