<div class="container">
    <div class="row">
        <div class="col-12">
            <h1><?php echo $this->getTitle() ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-12" id="column-left"><?php echo $this->getRegion('one') ?></div>
        <div class="col-lg-6 col-sm-6 col-xs-12" id="column-right"><?php echo $this->getData()['two'] ?></div>
    </div>
</div>